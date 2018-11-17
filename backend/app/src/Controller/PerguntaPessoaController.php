<?php

namespace App\Controller;

use App\Service\PerguntaPessoaService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class PerguntaPessoaController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new PerguntaPessoaService($this->container->get('em'));

            $perguntaPessoas = $service->findAll();

            $perguntaPessoas = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $perguntaPessoas
            );

            return $response->withJSON($perguntaPessoas);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new PerguntaPessoaService($this->container->get('em'));

            $perguntaPessoa = $service->findOne($args['id']);

            return $response->withJSON($perguntaPessoa->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new PerguntaPessoaService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function createOrUpdate(Request $request, Response $response)
    {
        try {
            $service = new PerguntaPessoaService($this->container->get('em'));

            $params = $request->getParams();
            $service->createOrUpdate(
                $params['pessoa']['id'],
                $params['pergunta']['id'],
                $params['resposta'],
                $params['data']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new PerguntaPessoaService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['pessoa'],
$params['pergunta'],
$params['resposta'],
$params['data']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
