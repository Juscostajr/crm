<?php

namespace App\Controller;

use App\Service\PerguntaService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class PerguntaController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new PerguntaService($this->container->get('em'));

            $perguntas = $service->findAll();

            $perguntas = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $perguntas
            );

            return $response->withJSON($perguntas);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new PerguntaService($this->container->get('em'));

            $pergunta = $service->findOne($args['id']);

            return $response->withJSON($pergunta->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new PerguntaService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new PerguntaService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['descricao'],
                $params['checklist']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new PerguntaService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['descricao'],
$params['checklist']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
