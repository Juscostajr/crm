<?php

namespace App\Controller;

use App\Entity\FeedBack;
use App\Factory\DoctrineParamsMapper;
use App\Service\FeedBackService;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class FeedBackController {

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
        $this->service = new FeedBackService($this->em);
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            return $response->write(
                $this->serializer->serialize($this->em->getRepository(FeedBack::class)->findAll(), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new FeedBackService($this->container->get('em'));

            $feedBack = $service->findOne($args['id']);

            return $response->withJSON($feedBack->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new FeedBackService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $this->service->create(
                new DoctrineParamsMapper(
                    FeedBack::class,
                    $request->getParams(),
                    $this->em
                )
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new FeedBackService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['justificativa'],
$params['data'],
$params['indicador'],
$params['hora'],
$params['observacao']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
