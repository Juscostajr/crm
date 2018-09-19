<?php

namespace App\Controller;

use App\Service\PessoaJuridicaService;
use Psr\Container\ContainerInterface;
use App\Entity;
use Slim\Http\Request;
use Slim\Http\Response;

class PessoaJuridicaController
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new PessoaJuridicaService($this->container->get('em'));

            $pessoaJuridicas = $service->findAll();

            $pessoaJuridicas = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $pessoaJuridicas
            );

            return $response->withJSON($pessoaJuridicas);
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new PessoaJuridicaService($this->container->get('em'));

            $pessoaJuridica = $service->findOne($args['id']);

            return $response->withJSON($pessoaJuridica->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new PessoaJuridicaService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new PessoaJuridicaService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['razaoSocial'],
                $params['telefones'],
                $params['enderecos'],
                $params['email'],
                $params['grupos'],
                $params['nomeFantasia'],
                $params['inscricaoEstadual'],
                $params['numeroFuncionarios'],
                $params['representanteLegal']['id']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new PessoaJuridicaService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'],
                $params['razaoSocial'],
                $params['telefones'],
                $params['enderecos'],
                $params['email'],
                $params['grupos'],
                $params['nomeFantasia'],
                $params['inscricaoEstadual'],
                $params['numeroFuncionarios'],
                $params['representanteLegal']['id']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
