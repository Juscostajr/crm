<?php

namespace App\Controller;

use App\Entity\Venda;
use App\Factory\DoctrineParamsMapper;
use App\Service\VendaService;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class VendaController {

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
        $this->service = new VendaService($this->em);
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            return $response->write(
                $this->serializer->serialize($this->em->getRepository(Venda::class)->findAll(), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new VendaService($this->container->get('em'));

            $venda = $service->findOne($args['id']);

            return $response->withJSON($venda->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findNaoAssociado(Request $request, Response $response){
        try{
            return $response->withJson($this->service->findNaoAssociados());
        } catch (\Exception $ex){
            return $response->withStatus(404,$ex);
        }
    }
    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new VendaService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new VendaService($this->container->get('em'));

            $params = $request->getParams();

            $service->create(
                $params['etapa'],
                $params['interacaos'],
                $params['interesses'],
                $params['pessoaJuridica']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new VendaService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'],
                $params['etapa'],
                $params['interacaos'],
                $params['interesses'],
                $params['pessoaJuridica']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(500);
        }
    }
}
