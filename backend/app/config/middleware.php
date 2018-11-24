<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
$container = $app->getContainer();

$app->add(new \App\Middleware\RouteValidatorMiddleware($container));

$app->add(new App\Middleware\LogMiddleware($container->get('logger')));
