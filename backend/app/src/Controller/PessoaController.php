<?php

namespace App\Controller;

use App\Entity\Pessoa;
use App\Factory\DoctrineParamsMapper;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class PessoaController {

    protected $container;
    private  $em;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('em');
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
