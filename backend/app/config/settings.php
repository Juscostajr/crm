<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

return [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    __DIR__ . '/../src/Entity'
                ],
                'auto_generate_proxies' => false,
                'proxy_dir' => __DIR__ . '/../../cache/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'dbname' => 'crmanalytic',
                'user' => 'root',
                'password' => '',
                'charset'  => 'utf8',
            ]
        ],
        'key' => 'V1t0r1@',
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
