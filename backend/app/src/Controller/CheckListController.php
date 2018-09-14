<?php
namespace App\Controller;

use App\Service\CheckListService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CheckListController
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new CheckListService($this->container->get('em'));
            $checkLists = $service->findAll();
            $checkLists = array_map(function ($photo) {
                return $photo->toArray();
            }, $checkLists);
            return $response->withJSON($checkLists);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new CheckListService($this->container->get('em'));
            $checkList = $service->findOne($args['id']);
            return $response->withJSON($checkList->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new CheckListService($this->container->get('em'));
            $service->delete($args['id']);
            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }

    public function create(Request $request, Response $response)
    {
        try {
            $service = new CheckListService($this->container->get('em'));
            $params = $request->getParams();
            $service->create($params['perguntas'], $params['grupo']);
            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }

    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new CheckListService($this->container->get('em'));
            $params = $request->getParams();
            $service->update($args['id'], $params['perguntas'], $params['grupo']);
            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);
        }
    }
}
