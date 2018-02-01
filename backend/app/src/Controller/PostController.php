<?php

namespace App\Controller;

use App\Service\PostService;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class PostController {

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function findAll(Request $request, Response $response)
    {
        try {
            $service = new PostService($this->container->get('em'));

            $posts = $service->findAll();

            $posts = array_map(
                function ($photo) {
                    return $photo->toArray();
                },
                $posts
            );
            
            return $response->withJSON($posts);            
        } catch (\Exception $ex) {
            return $response->withStatus(404);
        }
    }
    
    public function findOne(Request $request, Response $response, $args)
    {
        try {
            $service = new PostService($this->container->get('em'));

            $post = $service->findOne($args['id']);

            return $response->withJSON($post->toArray());
        } catch (\Exception $ex) {
            return $response->withStatus(404);   
        }
    }
    
    public function delete(Request $request, Response $response, $args)
    {
        try {
            $service = new PostService($this->container->get('em'));

            $service->delete($args['id']);

            return $response->withStatus(204);
        } catch (\Exception $ex) {
            return $response->withStatus(404); 
        }          
    }
    
    public function create(Request $request, Response $response)
    {
        try {
            $service = new PostService($this->container->get('em'));

            $params = $request->getParams();
            $service->create($params['title'], $params['description']);

            return $response->withStatus(201);
        } catch (\Exception $ex) {
            return $response->withStatus(500);     
        }       
    }
    
    public function update(Request $request, Response $response, $args)
    {
        try {
            $service = new PostService($this->container->get('em'));

            $params = $request->getParams();            

            $service->update($args['id'], $params['title'], $params['description']);

            return $response->withStatus(200);
        } catch (\Exception $ex) {
            return $response->withStatus(500);     
        }
    }
}
