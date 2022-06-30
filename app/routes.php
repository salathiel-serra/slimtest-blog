<?php 

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/login', '')->setName('auth.login');
$app->get('/register', '')->setName('auth.register');