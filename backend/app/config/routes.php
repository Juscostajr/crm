<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$app->get('/posts', App\Controller\PostController::class . ':findAll')->setName('find_all_post');

$app->get('/posts/{id}', App\Controller\PostController::class . ':findOne')->setName('find_one_post');

$app->post('/posts', App\Controller\PostController::class . ':create')
        ->setName('create_post')
        ->add(new App\Middleware\CreatePostValidatorMiddleware());

$app->put('/posts/{id}', App\Controller\PostController::class . ':update')
	->setName('update_post')
   	->add(new App\Middleware\CreatePostValidatorMiddleware());

$app->delete('/posts/{id}', App\Controller\PostController::class . ':delete')->setName('delete_post');


$app->get('/pj', App\Controller\PessoaJuridicaController::class . ':findAll')->setName('find_all_post');
$app->post('/pj', App\Controller\PessoaJuridicaController::class . ':create')
	->setName('create_pj');
	//->add(new App\Middleware\CreatePostValidatorMiddleware());
