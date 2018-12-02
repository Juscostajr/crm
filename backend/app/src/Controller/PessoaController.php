<?php

namespace App\Controller;

use App\Entity\Interacao;
use App\Entity\Pessoa;
use App\Factory\DoctrineParamsMapper;
use App\Service\PessoaService;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class PessoaController {

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
        $this->service = new PessoaService($this->em);
    }

    public function addInteracao(Request $request, Response $response, $args)
    {
        try {
            $this->service->addInteracao(
                $args['id'],
                new DoctrineParamsMapper(
                    Interacao::class,
                    $request->getParams(),
                    $this->em
                )
            );
            return $response->withStatus(201);
        } catch (\Exception $e){
            echo $e;
            return $response->withStatus(500);
        }
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $em = $this->container->get('em');
            $serializer = SerializerBuilder::create()->build();
            return $response->write(
                $serializer->serialize($em->getRepository(Pessoa::class)->findAll(), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $em = $this->container->get('em');
            $serializer = SerializerBuilder::create()->build();
            return $response->write(
                $serializer->serialize($em->getRepository(Pessoa::class)->findOne($args['id']), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }
}
