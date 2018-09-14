<?php

namespace App\Controller;

use App\Service\CidadeService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CidadeController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new CidadeService($this->container->get('em'));

            $cidades = $service->findAll();

            $cidades = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $cidades
            );

            return $response->withJSON($cidades);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new CidadeService($this->container->get('em'));

            $cidade = $service->findOne($args['id']);

            return $response->withJSON($cidade->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new CidadeService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new CidadeService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['uf'],
$params['nome'],
$params['coordenadas']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new CidadeService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['uf'],
$params['nome'],
$params['coordenadas']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
