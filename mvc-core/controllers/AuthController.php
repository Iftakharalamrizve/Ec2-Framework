<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\request\RegistrationRequest;


class AuthController extends Controller
{
    protected RegistrationRequest $registrationRequest ;
    protected User $userModel;

    public function __construct()
    {
        $this->registrationRequest = new RegistrationRequest();
        $this->userModel = new User();
    }

    public function register(Request $request)
    {

        if($request->isPost()){
            $errors = $request->validateRequest(
                [
                    'first_name'=>'required|max:256',
                    'last_name'=>'required|max:256',
                    'email'=>'required|email',
                    'password'=>'required|max:6|min:1',
                    'c_password'=>'match:password'
                ]);
            $this->userModel->loadUserData($request->inputs);

            if($errors && $this->userModel->create()){

            }
            return $this->withErrors($errors)->withInputs()->render('auth','auth.register');
        }
        return $this->render('auth','auth.register');
    }


    public function login(Request $request)
    {

        if ($this->registrationRequest->isPost()){
            $errors = $this->registrationRequest->validateRequest();
            $this->userModel->loadUserData($request->inputs);
            return $this->withErrors($errors)->withInputs()->render('auth','login');
        }
        return $this->render('auth','auth.login');
    }
}