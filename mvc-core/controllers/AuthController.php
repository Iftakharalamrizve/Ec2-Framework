<?php

namespace app\controllers;

use app\core\auth\Auth;
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
                    'email'=>'required|email|unique:users,email',
                    'password'=>'required|max:6|min:1',
                    'c_password'=>'match:password'
                ]);
            $this->userModel->loadUserData($request->inputs);

            if(!$errors && $this->userModel->save()){
                $this->redirect('/');
            }
            return $this->withErrors($errors)->withInputs()->render('auth','auth.register');
        }
        return $this->render('auth','auth.register');
    }


    public function login(Request $request)
    {
        if ($this->registrationRequest->isPost()){
            $errors = $this->registrationRequest->validateRequest(
                [
                    'email'=>'required|email',
                    'password'=>'required'
                ]
            );

           if(!$errors){
               $this->attemptLogin($request->inputs);
           }else{
               return $this->withErrors($errors)->withInputs()->render('auth','auth.login');
           }
        }
        return $this->render('auth','auth.login');
    }

    public  function attemptLogin(array $data)
    {
        $findUser = $this->userModel->findOne(['email'=>$data['email']]);
        if (!$findUser) {
            return false;
        }
        if (!password_verify($data['password'], $findUser->password)) {
            dd(123);
            return false;
        }

        $this->redirect('/');
    }
}