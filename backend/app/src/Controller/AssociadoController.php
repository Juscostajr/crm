<?php

namespace App\Controller;

use App\Service\AssociadoService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AssociadoController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new AssociadoService($this->container->get('em'));

            $associados = $service->findAll();

            $associados = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $associados
            );

            return $response->withJSON($associados);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new AssociadoService($this->container->get('em'));

            $associado = $service->findOne($args['id']);

            return $response->withJSON($associado->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new AssociadoService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new AssociadoService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['pessoa'],
$params['dataFiliacao'],
$params['status'],
$params['valorMensalidade'],
$params['adesoes']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new AssociadoService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['pessoa'],
$params['dataFiliacao'],
$params['status'],
$params['valorMensalidade'],
$params['adesoes']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
