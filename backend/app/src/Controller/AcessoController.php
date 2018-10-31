<?php
namespace App\Controller;

use App\Service\AdesaoService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AcessoController
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            return $response->withJson(
                array_unique(
                    array_map(function($route){
                        return strtok($route->getPattern(),'/');
                    }, $this->container->get('router')->getRoutes())
                )
            );
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new AdesaoService($this->container->get('em'));
            $adesao = $service->findOne($args['id']);
            return $response->withJSON($adesao->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new AdesaoService($this->container->get('em'));
            $service->delete($args['id']);
            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new AdesaoService($this->container->get('em'));
            $params = $request->getParams();
            $service->create($params['data'], $params['servico'], $params['associado']);
            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new AdesaoService($this->container->get('em'));
            $params = $request->getParams();
            $service->update($args['id'], $params['data'], $params['servico'], $params['associado']);
            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
