<?php

namespace App\Controller;

use App\Service\FeedBackService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class FeedBackController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new FeedBackService($this->container->get('em'));

            $feedBacks = $service->findAll();

            $feedBacks = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $feedBacks
            );

            return $response->withJSON($feedBacks);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new FeedBackService($this->container->get('em'));

            $feedBack = $service->findOne($args['id']);

            return $response->withJSON($feedBack->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new FeedBackService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new FeedBackService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['justificativa'],
$params['data'],
$params['indicador'],
$params['hora'],
$params['observacao']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new FeedBackService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['justificativa'],
$params['data'],
$params['indicador'],
$params['hora'],
$params['observacao']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
