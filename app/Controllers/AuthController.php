<?php

namespace App\Controllers;
use App\Models\User;

class AuthController extends Controller
{
    public function login($request, $response)
    {
        if($request->isGet())
            return $this->container->view->render($response, 'login.twig');
    }

    public function register($request, $response)
    {
        if($request->isGet())
            return $this->container->view->render($response, 'register.twig');


        $confirmationKey = bin2hex(random_bytes(20));

        $expirationDate  = new \DateTime(date('d/m/Y H:i:s'));
        $expirationDate->modify('+1 hour');

        User::create([
            'name'                  => $request->getParam('name'),
            'email'                 => $request->getParam('email'),
            'password'              => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
            'confirmation_key'      => $confirmationKey,
            'confirmation_expires'  => $expirationDate
        ]);

        return $response->withRedirect( $this->container->router->pathFor('auth.login') );
    }
}