<?php

namespace App\Controller;

use App\Service\EnderecoService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class EnderecoController
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new EnderecoService($this->container->get('em'));

            $enderecos = $service->findAll();

            $enderecos = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $enderecos
            );

            return $response->withJSON($enderecos);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new EnderecoService($this->container->get('em'));

            $endereco = $service->findOne($args['id']);

            return $response->withJSON($endereco->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new EnderecoService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new EnderecoService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['cep'],
                $params['nrImovel'],
                $params['proprietario'],
                $params['cidade'],
                $params['logradouro'],
                $params['complemento'],
                $params['coordenadas'],
                $params['bairro']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new EnderecoService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'],
                $params['cep'],
                $params['nrImovel'],
                $params['proprietario'],
                $params['cidade'],
                $params['logradouro'],
                $params['complemento'],
                $params['coordenadas'],
                $params['bairro']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
