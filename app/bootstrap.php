<?php

session_status();

date_default_timezone_set('America/Fortaleza');

require __DIR__ . '/../vendor/autoload.php';

$app = new Slim\App();

$container = $app->getContainer();

$container['HomeController'] = function($container){
    return new App\Controllers\HomeController($container);
};

require __DIR__ . '/routes.php';