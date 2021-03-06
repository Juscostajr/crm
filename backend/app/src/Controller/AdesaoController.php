<?php
namespace App\Controller;

use App\Entity\Adesao;
use App\Service\AdesaoService;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AdesaoController
{


    protected $container;
    private $em;
    private $service;
    private $serializer;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('em');
        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();
        $this->service = new AdesaoService($this->em);
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $em = $this->container->get('em');
            return $response->write(
                $this->serializer->serialize($em->getRepository(Adesao::class)->findAll(), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
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
