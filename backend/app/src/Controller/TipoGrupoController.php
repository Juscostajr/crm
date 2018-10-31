<?php
/**
 * Created by PhpStorm.
 * User: Juscelino Jr
 * Date: 11/10/2018
 * Time: 20:24
 */

namespace App\Controller;

use App\Entity\TipoGrupo;
use App\Service\TipoGrupoService;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class TipoGrupoController
{
    protected $container;
    private  $em;
    private $service;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('em');
        $this->service = new TipoGrupoService($this->em);
    }


    public function findAll(Request $request, Response $response){
        try{
            $serializer = SerializerBuilder::create()->build();
            return $response->write(
                $serializer->serialize($this->em->getRepository(TipoGrupo::class)->findAll(), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }
}