<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\UserPermission;
use Respect\Validation\Validator as v;

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


        $validation = $this->container->validator->validate($request, [
            'name' => v::notEmpty()->alpha()->length(10), 
            'email' => v::notEmpty()->noWhitespace()->email(), 
            'password' => v::notEmpty()->noWhitespace()
        ]);
        // var_dump( $validation->failed()); die;
        if ($validation->failed())
            return $response->withRedirect( $this->container->router->pathFor('auth.register') );

        $confirmationKey = bin2hex(random_bytes(20));

        $expirationDate  = new \DateTime(date('d/m/Y H:i:s'));
        $expirationDate->modify('+1 hour');

        $user = User::create([
            'name'                  => $request->getParam('name'),
            'email'                 => $request->getParam('email'),
            'password'              => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
            'confirmation_key'      => $confirmationKey,
            'confirmation_expires'  => $expirationDate
        ]);

        $user->permission()->create(UserPermission::$defaults);

        return $response->withRedirect( $this->container->router->pathFor('auth.login') );
    }
}