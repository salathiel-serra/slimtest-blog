<?php

namespace App\Controllers;

class HomeController
{
    public function index($request, $response)
    {
        return $response->write('HELLO WORLD!');
    }
}