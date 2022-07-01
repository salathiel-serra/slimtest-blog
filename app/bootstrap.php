<?php

session_status();

date_default_timezone_set('America/Fortaleza');

require __DIR__ . '/../vendor/autoload.php';

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver'    => 'mysql',
            'host'      => 'sblog_mysql',
            'database'  => 'sblog',
            'username'  => 'root',
            'password'  => 'r00t',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ]
    ]
]);

$container = $app->getContainer();

// Configurando conexão com banco de dados
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();



$container['view'] = function($container){
    $view = new Slim\Views\Twig(__DIR__ .'/../resources/views', [
        'cache' => false
    ]);

    $view->addExtension(new Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

$container['HomeController'] = function($container){
    return new App\Controllers\HomeController($container);
};

$container['AuthController'] = function($container){
    return new App\Controllers\AuthController($container);
};

require __DIR__ . '/routes.php';