<?php
namespace App\Controller;

use App\Service\AdesaoService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AdesaoController
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new AdesaoService($this->container->get('em'));
            $adesaos = $service->findAll();
            $adesaos = array_map(function ($photo) {
                return $photo->toArray();
            }, $adesaos);
            return $response->withJSON($adesaos);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new AdesaoService($this->container->get('em'));
            $adesao = $service->findOne($args['id']);
            return $response->withJSON($adesao->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new AdesaoService($this->container->get('em'));
            $service->delete($args['id']);
            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }



    public function deleteByAssociado(Request $request, Response $response, $args)
    {
        try {
            $service = new AdesaoService($this->container->get('em'));
            $service->delete($args['id']);
            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }



    public function create(Request $request, Response $response)
    {
        try {
            $service = new AdesaoService($this->container->get('em'));
            $params = $request->getParams();
            $service->create($params['data'], $params['servico'], $params['associado']);
            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new AdesaoService($this->container->get('em'));
            $params = $request->getParams();
            $service->update($args['id'], $params['data'], $params['servico'], $params['associado']);
            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
