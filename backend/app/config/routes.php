<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
$app->get('/telefone', App\Controller\TIpoTelefoneController::class . ':getAll')->setName('find_all_tipotelefone');
$app->get('/operadora', App\Controller\OperadoraController::class . ':findAll')->setName('find_all_operadora');
$app->get('/pf', App\Controller\PessoaFisicaController::class . ':findAll')->setName('find_all_pessoafisica');

$app->get('/grupo', App\Controller\GrupoController::class . ':findAll')->setName('find_all_grupo');
$app->get('/ramo', App\Controller\RamoAtividadeController::class . ':findAll')->setName('find_all_ramoatividade');
$app->get('/posts', App\Controller\PostController::class . ':findAll')->setName('find_all_post');

$app->get('/posts/{id}', App\Controller\PostController::class . ':findOne')->setName('find_one_post');

$app->post('/posts', App\Controller\PostController::class . ':create')
        ->setName('create_post')
        ->add(new App\Middleware\CreatePostValidatorMiddleware());

$app->put('/posts/{id}', App\Controller\PostController::class . ':update')
	->setName('update_post')
   	->add(new App\Middleware\CreatePostValidatorMiddleware());

$app->delete('/posts/{id}', App\Controller\PostController::class . ':delete')->setName('delete_post');


$app->get('/pj', App\Controller\PessoaJuridicaController::class . ':findAll')->setName('find_all_pj');
$app->get('/pj/{nomeFantasia}', App\Controller\PessoaJuridicaController::class . ':findByName')->setName('find_many_pj');
$app->post('/pj', App\Controller\PessoaJuridicaController::class . ':create')
	->setName('create_pj');
$app->delete('/pj/{id}', App\Controller\PessoaJuridicaController::class . ':delete')->setName('delete_pj');
	//->add(new App\Middleware\CreatePostValidatorMiddleware());
