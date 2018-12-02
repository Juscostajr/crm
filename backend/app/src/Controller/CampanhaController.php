<?php

namespace App\Controller;

use App\Entity\Campanha;
use App\Entity\PerguntaPessoa;
use App\Entity\Pessoa;
use App\Service\CampanhaService;
use App\Service\PerguntaPessoaService;
use Doctrine\ORM\EntityManager;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CampanhaController {

    /**
     * @var EntityManager $em
     */
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
        $this->service = new CampanhaService($this->em);
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            return $response->write(
                $this->serializer->serialize($this->em->getRepository(Campanha::class)->findAll(), 'json')
            );
        } catch (\Exception $ex) {
            echo $ex;
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new CampanhaService($this->container->get('em'));

            $campanha = $service->findOne($args['id']);

            return $response->withJSON($campanha->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function listPerguntasRespostas(Request $request, Response $response, $args){
        try {
            /**
             * @var Campanha $campanha
             */
            $campanha = $this->em->find(Campanha::class,$args['id']);

            $respostas = array();
            foreach ($campanha->getTarget()->getMembros() as $pessoa){
                /**
                 * @var Pessoa $pessoa
                 */
                $perguntaPessoa = new PerguntaPessoaService($this->em);
                $respostasPessoa = $perguntaPessoa->findByCampanha($campanha, $pessoa);
                array_push($respostas, $respostasPessoa);
            }
            return $response->write(
                $this->serializer->serialize($respostas, 'json')
            );


        }catch (\Exception $e){
            return $response->withStatus(500);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new CampanhaService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new CampanhaService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['servico']['id'],
                $params['target']['id'],
                $params['nome'],
                $params['descricao'],
                $params['inicio'],
                $params['final']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function addPerguntas(Request $request, Response $response)
    {
        try {
            $service = new CampanhaService($this->container->get('em'));

            $params = $request->getParams();
            $service->addPerguntas(
                $params['id'],
                $params['perguntas']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500, $ex);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new CampanhaService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'], 
                $params['target'],
$params['feedback'],
$params['nome'],
$params['descricao'],
$params['inicio'],
$params['final']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
