<?php

$container = $app->getContainer();

// doctrine - entity manager
$container['em'] = function ($c) {
    $doctrine = $c->get('settings')['doctrine'];

    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $doctrine['meta']['entity_path'],
        $doctrine['meta']['auto_generate_proxies'],
        $doctrine['meta']['proxy_dir'],
        $doctrine['meta']['cache'],
        false
    );

    return \Doctrine\ORM\EntityManager::create($doctrine['connection'], $config);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];

    $logger = new Monolog\Logger($settings['name']);
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};
