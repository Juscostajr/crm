<?php

namespace App\Controller;

use App\Service\GrupoService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class GrupoController
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new GrupoService($this->container->get('em'));

            $grupos = $service->findAll();

            $grupos = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $grupos
            );

            return $response->withJSON($grupos);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new GrupoService($this->container->get('em'));

            $grupo = $service->findOne($args['id']);

            return $response->withJSON($grupo->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new GrupoService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new GrupoService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['tipo'],
                $params['descricao'],
                $params['membros']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new GrupoService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'],
                $params['tipo'],
                $params['descricao'],
                $params['membros']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
