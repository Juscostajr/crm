<?php

namespace App\Controller;

use App\Service\CoordenadasService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CoordenadasController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new CoordenadasService($this->container->get('em'));

            $coordenadass = $service->findAll();

            $coordenadass = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $coordenadass
            );

            return $response->withJSON($coordenadass);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new CoordenadasService($this->container->get('em'));

            $coordenadas = $service->findOne($args['id']);

            return $response->withJSON($coordenadas->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new CoordenadasService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new CoordenadasService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['latitude'],
$params['longitude']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new CoordenadasService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['latitude'],
$params['longitude']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
