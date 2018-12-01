<?php

namespace App\Controller;

use App\Entity\Associado;
use App\Service\AssociadoService;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AssociadoController {

    protected $container;
    private  $em;
    private $service;
    private $serializer;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('em');
        $this->service = new AssociadoService($this->em);
        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();
    }

    public function findAll(Request $request, Response $response)
    {
        try {

            $em = $this->container->get('em');
            return $response->write(
                $this->serializer->serialize($em->getRepository(Associado::class)->find(), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new AssociadoService($this->container->get('em'));

            $pessoaFisica = $service->findOne($args['id']);

            return $response->withJSON($pessoaFisica->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findByPessoa(Request $request, Response $response,array $args)
    {

        try {
            $em = $this->container->get('em');
            $search = $em->getRepository(Associado::class)->findBy($args)[0];
            if(empty($search)) throw new \OutOfBoundsException();
            return $response->write(
                $this->serializer->serialize($search, 'json')
            );
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findBy(Request $request, Response $response,array $args)
    {

        try {
            $em = $this->container->get('em');
            $search = $em->getRepository(Associado::class)->findBy($args);
            if(empty($search)) throw new \OutOfBoundsException();
            return $response->write(
                $this->serializer->serialize($search, 'json')
            );
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new AssociadoService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new AssociadoService($this->container->get('em'));
            $params = $request->getParams();
            $service->create(
                $params['pessoaJuridica']['id'],
                $params['dataFiliacao'],
                $params['statusAssociado'],
                $params['valorMensalidade']['id'],
                $params['adesoes'],
                $params['id'] ?? null
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500,$ex->getMessage());
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new AssociadoService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['pessoa'],
                $params['dataFiliacao'],
                $params['status'],
                $params['valorMensalidade'],
                $params['adesoes']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
