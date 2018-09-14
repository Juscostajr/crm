<?php

namespace App\Controller;

use App\Service\PerfilService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class PerfilController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new PerfilService($this->container->get('em'));

            $perfils = $service->findAll();

            $perfils = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $perfils
            );

            return $response->withJSON($perfils);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new PerfilService($this->container->get('em'));

            $perfil = $service->findOne($args['id']);

            return $response->withJSON($perfil->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new PerfilService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new PerfilService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['acessos'],
$params['descricao'],
$params['usuario']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new PerfilService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['acessos'],
$params['descricao'],
$params['usuario']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
