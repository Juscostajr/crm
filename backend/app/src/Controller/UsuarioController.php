<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Factory\DoctrineParamsMapper;
use App\Service\UsuarioService;
use Doctrine\Common\Proxy\Exception\OutOfBoundsException;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Psr\Log\InvalidArgumentException;
use Slim\Http\Request;
use Slim\Http\Response;

class UsuarioController
{

    protected $container;
    protected $service;
    private $em;
    private $serializer;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('em');
        $this->serializer = SerializerBuilder::create()->build();
        $this->service = new UsuarioService($this->em);
    }

    public function auth(Request $request, Response $response)
    {
        try {
        $search = $this->em->getRepository(Usuario::class)->findBy($request->getParams());
        if(empty($search)) throw new OutOfBoundsException();

            return $response->write(
                $this->serializer->serialize($search[0], 'json')
            );
        } catch (\OutOfBoundsException $ex){
            return $response->withStatus(403);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function getAccess(Request $request, Response $response, $args){
        print_r($this
            ->service
            ->getPermissions($args['id']));
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            return $response->write(
                $this->serializer->serialize($this->em->getRepository(Usuario::class)->findAll(), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }

    public function findByName(Request $request, Response $response, $args)
    {
        try {
            $em = $this->container->get('em');
            $serializer = SerializerBuilder::create()->build();
            return $response->write(
                $serializer->serialize($em->getRepository(Usuario::class)->findBy($args)[0], 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new UsuarioService($this->container->get('em'));

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
                    Usuario::class,
                    $request->getParams(),
                    $this->em
                )
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            $response->write($ex);
            return $response->withStatus(500);
        }
    }

    public function alterOwnPass(Request $request, Response $response)
    {
        try {
            $params = $request->getParams();
            $this->service->alterOwnPass(
                $params['usuario']['id'],
                $params['senha'],
                $params['novaSenha']
            );
            return $response->withStatus(201);
        } catch (InvalidArgumentException $ex) {
            return $response->withStatus(403,$ex);
        } catch (\Exception $ex) {
            return $response->withStatus(500,$ex);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new UsuarioService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'],
                $params['login'],
                $params['pessoa'],
                $params['senha'],
                $params['perfis'],
                $params['acoes']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
