<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\request\RegistrationRequest;


class AuthController extends Controller
{
    protected RegistrationRequest $registrationRequest;

    public function __construct()
    {
        $this->registrationRequest = new RegistrationRequest();
    }

    public function register(Request $request)
    {
        if($request->isPost()){

        }
        $this->setLayout('auth');
        return $this->render('auth','register');
    }


    public function login(Request $request)
    {
        $userModel = new User();
        if ($this->registrationRequest->isPost()){
            $errors = $this->registrationRequest->validateRequest();
            $userModel->loadUserData($request->inputs);
            return $this->withErrors($errors)->withInputs()->render('auth','login');
        }
        return $this->render('auth','login');
    }
}