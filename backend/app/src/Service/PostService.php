<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use App\Entity\Post;

class PostService {

    /**
     * @var EntityManager 
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function findAll()
    {
        $posts = $this->em->getRepository('\App\Entity\Post')->findAll();

        if (!$posts) {
            throw new \Exception("Posts not found", 404);
        }
        
        return $posts;
    }

    public function findOne(int $id): Post
    {
        $post = $this->em->getRepository('\App\Entity\Post')->findOneById($id);

        if (!$post) {
            throw new \Exception("Post not found", 404);
        }
        
        return $post;
    }

    public function delete(int $id)
    {
        $post = $this->findOne($id);
        
        $this->em->remove($post);
        $this->em->flush();
    }

    public function create(string $title, string $description) 
    {
        $post = new Post();
        $post->setTitle($title);
        $post->setDescription($description);

        $this->em->persist($post);
        $this->em->flush();
    }

    public function update(int $id, string $title, string $description) 
    {
        $post = $this->findOne($id);
        
        $post->setTitle($title);
        $post->setDescription($description);
        
        $this->em->persist($post);
        $this->em->flush();
    }

}
