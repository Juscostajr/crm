<?php

namespace App\Controller;

use App\Service\InteracaoService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class InteracaoController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new InteracaoService($this->container->get('em'));

            $interacaos = $service->findAll();

            $interacaos = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $interacaos
            );

            return $response->withJSON($interacaos);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new InteracaoService($this->container->get('em'));

            $interacao = $service->findOne($args['id']);

            return $response->withJSON($interacao->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new InteracaoService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new InteracaoService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['feedback'],
$params['acao'],
$params['data'],
$params['hora'],
$params['tipo'],
$params['anotacoes']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new InteracaoService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['feedback'],
$params['acao'],
$params['data'],
$params['hora'],
$params['tipo'],
$params['anotacoes']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
