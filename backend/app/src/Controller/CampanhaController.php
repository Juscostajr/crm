<?php

namespace App\Controller;

use App\Service\CampanhaService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CampanhaController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new CampanhaService($this->container->get('em'));

            $campanhas = $service->findAll();

            $campanhas = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $campanhas
            );

            return $response->withJSON($campanhas);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new CampanhaService($this->container->get('em'));

            $campanha = $service->findOne($args['id']);

            return $response->withJSON($campanha->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new CampanhaService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new CampanhaService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['target'],
$params['feedback'],
$params['nome'],
$params['descricao'],
$params['inicio'],
$params['final']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new CampanhaService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['target'],
$params['feedback'],
$params['nome'],
$params['descricao'],
$params['inicio'],
$params['final']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
