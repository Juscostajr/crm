<?php

namespace App\Controller;

use App\Service\UsuarioService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class UsuarioController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new UsuarioService($this->container->get('em'));

            $usuarios = $service->findAll();

            $usuarios = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $usuarios
            );

            return $response->withJSON($usuarios);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new UsuarioService($this->container->get('em'));

            $usuario = $service->findOne($args['id']);

            return $response->withJSON($usuario->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new UsuarioService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new UsuarioService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['login'],
$params['pessoa'],
$params['senha'],
$params['perfis'],
$params['acoes']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new UsuarioService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['login'],
$params['pessoa'],
$params['senha'],
$params['perfis'],
$params['acoes']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
