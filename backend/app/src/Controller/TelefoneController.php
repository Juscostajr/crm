<?php

namespace App\Controller;

use App\Service\TelefoneService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class TelefoneController
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new TelefoneService($this->container->get('em'));

            $telefones = $service->findAll();

            $telefones = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $telefones
            );

            return $response->withJSON($telefones);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new TelefoneService($this->container->get('em'));

            $telefone = $service->findOne($args['id']);

            return $response->withJSON($telefone->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new TelefoneService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new TelefoneService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['numero'],
                $params['proprietario'],
                $params['operadora'],
                $params['tipo']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new TelefoneService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'],
                $params['numero'],
                $params['proprietario'],
                $params['operadora'],
                $params['tipo']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
