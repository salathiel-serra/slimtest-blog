<?php

session_status();

date_default_timezone_set('America/Fortaleza');

require __DIR__ . '/../vendor/autoload.php';

$app = new Slim\App();

require __DIR__ . '/routes.php';