<?php

namespace App\Controller;

use App\Service\PessoaFisicaService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class PessoaFisicaController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new PessoaFisicaService($this->container->get('em'));

            $pessoaFisicas = $service->findAll();

            $pessoaFisicas = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $pessoaFisicas
            );

            return $response->withJSON($pessoaFisicas);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new PessoaFisicaService($this->container->get('em'));

            $pessoaFisica = $service->findOne($args['id']);

            return $response->withJSON($pessoaFisica->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new PessoaFisicaService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new PessoaFisicaService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['dtNascimento']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new PessoaFisicaService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['dtNascimento']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
