<?php

namespace App\Controller;

use App\Service\VendaService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class VendaController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new VendaService($this->container->get('em'));

            $vendas = $service->findAll();

            $vendas = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $vendas
            );

            return $response->withJSON($vendas);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new VendaService($this->container->get('em'));

            $venda = $service->findOne($args['id']);

            return $response->withJSON($venda->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new VendaService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new VendaService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['etapa'],
$params['interesses'],
$params['data'],
$params['hora']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new VendaService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['etapa'],
$params['interesses'],
$params['data'],
$params['hora']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
