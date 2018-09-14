<?php

namespace App\Controller;

use App\Service\DesfiliacaoService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class DesfiliacaoController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new DesfiliacaoService($this->container->get('em'));

            $desfiliacaos = $service->findAll();

            $desfiliacaos = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $desfiliacaos
            );

            return $response->withJSON($desfiliacaos);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new DesfiliacaoService($this->container->get('em'));

            $desfiliacao = $service->findOne($args['id']);

            return $response->withJSON($desfiliacao->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new DesfiliacaoService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new DesfiliacaoService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['associado'],
$params['data'],
$params['motivos']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new DesfiliacaoService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['associado'],
$params['data'],
$params['motivos']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
