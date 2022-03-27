<?php

namespace app\core\auth;

use app\core\Application;
use app\core\DBModel\DBModel;
use app\core\Session;

class Auth
{

    protected $user ;
    protected Session $session;
    protected $userClass;

    public function __construct()
    {
        $this->userClass = Application::$app->user;
        $this->session = Application::$app->session;
    }

    public function __call($name, $arguments)
    {
        $name .=  'Auth';
        if(method_exists($this,$name)){

            return call_user_func_array(array($this, $name), $arguments);
        }
    }

    public static function __callStatic($name, $arguments)
    {
        $name .=  'Auth';
        if(method_exists(Auth::class,$name)){
            $authObject = new Auth();
             /**
             * You can write here any code you want to be run
             * before a static method is called
             */
            return call_user_func_array(array($authObject, $name), $arguments);
        }
    }

    public  function loginAuth(DBModel $user):bool
    {
        try {
            $this->user = $user;
            $primaryKey = $user->primaryKey();
            $primaryKeyValue = $user->{$primaryKey};
            $this->session->set('user',$primaryKeyValue);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public  function logoutAuth()
    {
        $this->user = null;
        $this->session->remove('user');
        return true;
    }

    public function isGuestAuth()
    {
        $user = $this->userAuth();
        if($user){
            return false;
        }
        return true;

    }

    public  function userAuth()
    {
        $userId =  $this->session->get('user');
        if ($userId) {
            $key = $this->userClass->primaryKey();
            $userFind =  $this->userClass->findOne([$key => $userId]);
            if(!$userFind){
                return null;
            }
            return $userFind;
        }
        return null;
    }

}