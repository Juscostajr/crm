<?php

namespace App\Controller;

use App\Factory\DoctrineJsonSerializator;
use App\Factory\DoctrineParamsMapper;
use App\Service\RamoAtividadeService;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use App\Entity;
use Slim\Http\Request;
use Slim\Http\Response;

class RamoAtividadeController
{

    protected $container;
    private $em;
    private $service;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('em');
        $this->service = new RamoAtividadeService($this->em);
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $em = $this->container->get('em');
            $service = new RamoAtividadeService($em);

           $serializer = SerializerBuilder::create()->build();
           ;

//            $serializer = new DoctrineJsonSerializator($em->getRepository('\App\Entity\RamoAtividade')->findAll());
//            echo var_dump($serializer->getArray());
//            $ramoAtividades = $service->findAll();
//
//            $ramoAtividades = array_map(
//                function ($photo) {
//                    return $photo->toArray();
//                },
//                $ramoAtividades
//            );
//
            return $response->write(
                $serializer->serialize($em->getRepository('\App\Entity\RamoAtividade')->findAll(), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new RamoAtividadeService($this->container->get('em'));
            $serializer = SerializerBuilder::create()->build();
            $serializer->serialize($service, 'json');

            echo $serializer;


            //$ramoAtividade = $service->findOne($args['id']);

           // return $response->withJSON($ramoAtividade->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new RamoAtividadeService($this->container->get('em'));

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
                    Entity\RamoAtividade::class,
                    $request->getParams(),
                    $this->em
                )
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new RamoAtividadeService($this->container->get('em'));

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
