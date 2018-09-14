<?php

namespace App\Controller;

    use App\Service\OperadoraService;
    use Psr\Container\ContainerInterface;
    use Slim\Http\Request;
    use Slim\Http\Response;

class OperadoraController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new OperadoraService($this->container->get('em'));

            $operadoras = $service->findAll();

            $operadoras = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $operadoras
            );

            return $response->withJSON($operadoras);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new OperadoraService($this->container->get('em'));

            $operadora = $service->findOne($args['id']);

            return $response->withJSON($operadora->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new OperadoraService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new OperadoraService($this->container->get('em'));

            $params = $request->getParams();
            $service->create(
                $params['nome']
            );

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new OperadoraService($this->container->get('em'));

            $params = $request->getParams();

            $service->update(
                $args['id'],
                $params['nome']
            );

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}