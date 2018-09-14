<?php

namespace App\Controller;

use App\Service\AnotacaoService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AnotacaoController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new AnotacaoService($this->container->get('em'));

            $anotacaos = $service->findAll();

            $anotacaos = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $anotacaos
            );

            return $response->withJSON($anotacaos);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new AnotacaoService($this->container->get('em'));

            $anotacao = $service->findOne($args['id']);

            return $response->withJSON($anotacao->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new AnotacaoService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new AnotacaoService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['data'],
$params['hora'],
$params['descricao'],
$params['interacao']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new AnotacaoService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['data'],
$params['hora'],
$params['descricao'],
$params['interacao']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
