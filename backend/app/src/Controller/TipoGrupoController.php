<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 24/11/2018
 * Time: 18:49
 */

namespace App\Controller;


use App\Entity\TipoGrupo;
use App\Service\TipoGrupoService;
use Doctrine\ORM\EntityManager;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class TipoGrupoController
{

    protected $container;
    /**
     * @var $em EntityManager
     */
    private  $em;
    private $service;
    private $serializer;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('em');
        $this->service = new TipoGrupoService($this->em);
        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            return $response->write(
                $this->serializer->serialize(
                    $this->em->getRepository(TipoGrupo::class)->findAll(), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            return $response->write(
                $this->serializer->serialize(
                    $this->em->getRepository(TipoGrupo::class)->find($args['id']), 'json')
            );
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $this->service->delete($args['id']);
            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $this->service->create(
                $request->getParam('descricao')
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $this->service->update(
                $args['id'],
                $request->getParam('descricao')
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}