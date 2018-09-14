<?php

namespace App\Controller;

use App\Service\UfService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class UfController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new UfService($this->container->get('em'));

            $ufs = $service->findAll();

            $ufs = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $ufs
            );

            return $response->withJSON($ufs);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new UfService($this->container->get('em'));

            $uf = $service->findOne($args['id']);

            return $response->withJSON($uf->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new UfService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new UfService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['sigla'],
$params['nome']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new UfService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['sigla'],
$params['nome']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
