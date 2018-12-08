<?php

namespace App\Controller;

use App\Entity\Desfiliacao;
use App\Factory\DoctrineParamsMapper;
use App\Service\DesfiliacaoService;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class DesfiliacaoController {

    private $em;
    private $serializer;
    protected $container;
    protected $service;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('em');
        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();
        $this->service = new DesfiliacaoService($this->em);
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            return $response->write(
                $this->serializer->serialize($this->em->getRepository(Operadora::class)->findAll(), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new DesfiliacaoService($this->container->get('em'));

            $desfiliacao = $service->findOne($args['id']);

            return $response->withJSON($desfiliacao->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new DesfiliacaoService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        $params = $request->getParams();
        try {
            $this->service->create(
                $params['associado']['id'],
                $params['data'],
                $params['motivo']

            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500, $ex->getMessage());
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new DesfiliacaoService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['associado'],
                $params['data'],
                $params['motivos']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
