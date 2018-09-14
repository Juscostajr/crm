<?php

namespace App\Controller;

use App\Service\ServicoService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ServicoController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new ServicoService($this->container->get('em'));

            $servicos = $service->findAll();

            $servicos = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $servicos
            );

            return $response->withJSON($servicos);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new ServicoService($this->container->get('em'));

            $servico = $service->findOne($args['id']);

            return $response->withJSON($servico->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new ServicoService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new ServicoService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['descricao'],
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
            $service = new ServicoService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['descricao'],
$params['adesoes']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
