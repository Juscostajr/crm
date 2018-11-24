<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 17/11/2018
 * Time: 13:32
 */


namespace App\Middleware;

use Firebase\JWT\JWT;
use Psr\Container\ContainerInterface;
use Slim\Http\Response;
use Slim\Http\Request;


class RouteValidatorMiddleware
{
    private $key;
    private $payload;
    private $requestPath;
    private $userPaths;

    /**
     * RouteValidatorMiddleware constructor.
     */
    public function __construct(ContainerInterface $container)
    {
        $this->key = $container['settings']['key'];
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        try {
            $this->requestPath = $this->getPath($request->getUri()->getPath());

            if ($request->getMethod() == 'OPTIONS' || $this->requestPath == 'auth') {
                return $next($request, $response);
            }

            $this->payload = JWT::decode($request->getHeader('X-Token')[0], $this->key, array('HS256'));

            $this->userPaths = $this->mapPaths($this->payload->rotas);

            if (!$this->authorizedPath()) {
                return $response->withStatus(401, 'User is not authorized to use this route.');
            }

            if (!$this->authorizedMethod($request->getMethod())) {
                return $response->withStatus(401, 'User is not authorized to use this method');
            }


        } catch (\Exception $e) {
            return $response->withStatus(403,$e->getMessage());
        }

        return $next($request, $response);


    }

    private function getPath($pattern)
    {
        return strtok($pattern, '/');
    }

    private function authorizedPath(): bool
    {
        return in_array($this->requestPath, $this->userPaths);
    }

    private function authorizedMethod($method): bool
    {
        $actionatedRoute = array_filter(
            $this->payload->rotas, function ($rota) {
            return $rota->rota == $this->requestPath;
        });
        foreach ($actionatedRoute as $route) {
            if (boolval($route->$method)) {
                return true;
            }
        }
        return false;
    }

    private function mapPaths($rotas){
        return array_map(function ($rota) {
            return $rota->rota;
        }, $rotas);
    }

}
