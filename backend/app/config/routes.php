<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

$app->get('/associado/{id}', \App\Controller\AssociadoController::class . ':findOne');
$app->get('/associado/pessoa/{pessoaJuridica}', \App\Controller\AssociadoController::class . ':findByPessoa');
$app->get('/associado/status/{statusAssociado}', \App\Controller\AssociadoController::class . ':findBy');
$app->post('/associado', App\Controller\AssociadoController::class . ':create');
$app->get('/associado', \App\Controller\AssociadoController::class . ':findAll');

$app->get('/desfiliacao/motivo', \App\Controller\MotivoDesfiliacaoController::class . ':getAll');
$app->post('/desfiliacao', \App\Controller\DesfiliacaoController::class . ':create');

$app->post('/auth', App\Controller\UsuarioController::class . ':auth');
$app->get('/acesso/usuario/{id}', \App\Controller\UsuarioController::class . ':getAccess');

$app->get('/telefone', App\Controller\TIpoTelefoneController::class . ':getAll');
$app->get('/etapa', App\Controller\EtapaController::class . ':getAll');

$app->get('/pf', App\Controller\PessoaFisicaController::class . ':findAll');
$app->post('/pf', App\Controller\PessoaFisicaController::class . ':create');
$app->get('/pf/{nome}', App\Controller\PessoaFisicaController::class . ':findByName');
$app->delete('/pf/{id}', App\Controller\PessoaFisicaController::class . ':delete');

$app->get('/pessoa', App\Controller\PessoaController::class . ':findAll');

$app->get('/grupo', App\Controller\GrupoController::class . ':findAll');
$app->post('/grupo', App\Controller\GrupoController::class . ':create');
$app->get('/grupo/{descricao}', App\Controller\GrupoController::class . ':findByName');
$app->delete('/grupo/{id}', App\Controller\GrupoController::class . ':delete');

$app->get('/usuario', App\Controller\UsuarioController::class . ':findAll');
$app->post('/usuario', App\Controller\UsuarioController::class . ':create');
$app->get('/usuario/{login}', App\Controller\UsuarioController::class . ':findByName');
$app->delete('/usuario/{id}', App\Controller\UsuarioController::class . ':delete');
$app->put('/senha', \App\Controller\UsuarioController::class . ':alterOwnPass');

$app->get('/operadora', App\Controller\OperadoraController::class . ':findAll');
$app->post('/operadora', App\Controller\OperadoraController::class . ':create');
$app->get('/operadora/{descricao}', App\Controller\OperadoraController::class . ':findByName');
$app->delete('/operadora/{id}', App\Controller\OperadoraController::class . ':delete');

$app->get('/servico', App\Controller\ServicoController::class . ':findAll');
$app->post('/servico', App\Controller\ServicoController::class . ':create');
$app->get('/servico/{descricao}', App\Controller\ServicoController::class . ':findByName');
$app->delete('/servico/{id}', App\Controller\ServicoController::class . ':delete');

$app->get('/acesso', App\Controller\AcessoController::class . ':findAll');

$app->get('/perfil', App\Controller\PerfilController::class . ':findAll');
$app->post('/perfil', App\Controller\PerfilController::class . ':create');
$app->get('/perfil/{descricao}', App\Controller\PerfilController::class . ':findByName');
$app->delete('/perfil/{id}', App\Controller\PerfilController::class . ':delete');

$app->get('/tipogrupo', App\Controller\TipoGrupoController::class . ':findAll');

$app->get('/ramo', App\Controller\RamoAtividadeController::class . ':findAll');

$app->get('/pj', App\Controller\PessoaJuridicaController::class . ':findAll');
$app->get('/pj/{nomeFantasia}', App\Controller\PessoaJuridicaController::class . ':findByName');
$app->post('/pj', App\Controller\PessoaJuridicaController::class . ':create');
$app->delete('/pj/{id}', App\Controller\PessoaJuridicaController::class . ':delete');
//->add(new App\Middleware\CreatePostValidatorMiddleware());


//Movimentações

$app->get('/venda', App\Controller\VendaController::class . ':findAll');
$app->put('/venda/{id}', App\Controller\VendaController::class . ':update');
$app->post('/venda', \App\Controller\VendaController::class . ':create');
//$app->get('/pj/{nomeFantasia}', App\Controller\PessoaJuridicaController::class . ':findByName');
//$app->post('/pj', App\Controller\PessoaJuridicaController::class . ':create');
//$app->delete('/pj/{id}', App\Controller\PessoaJuridicaController::class . ':delete');

//$app->get('/interacao', App\Controller\InteracaoController::::class . ':findAll');
//$app->get('/pj/{nomeFantasia}', App\Controller\PessoaJuridicaController::class . ':findByName');
//$app->post('/pj', App\Controller\PessoaJuridicaController::class . ':create');
//$app->delete('/pj/{id}', App\Controller\PessoaJuridicaController::class . ':delete');
$app->put('/interacao', App\Controller\InteracaoController::class . ':createOrUpdate');
$app->put('/interacao/feedback', \App\Controller\InteracaoController::class . ':registerFeedback');


$app->post('/feedback', \App\Controller\FeedBackController::class . ':create');


