<?php

namespace app\core\auth;

use app\core\Application;
use app\core\DBModel\DBModel;

class Auth
{
    protected static $user;
    protected static $session;
    protected static $userClass;

    static function __callStatic ( string $name , array $arguments )
    {   dd(Application::$app->session);
        self::$session = Application::$app->session;
        self::$userClass = Application::$app->user;
        return call_user_func_array([Auth::class, $name], $arguments);
    }

    public static function login(DBModel $user):bool
    {
        try {
            self::$user = $user;
            $primaryKey = $user->primaryKey();
            $primaryKeyValue = $user->{$primaryKey};
            self::$session->set('user',$primaryKeyValue);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    public static function logout()
    {
        self::$user = null;
        $session = Application::$app->session;
        $session->remove('user');
    }

    public static function user()
    {
        dd(self::$session);
        $userId =  self::$session->get('user');
        if ($userId) {
            $key = self::$userClass->primaryKey();
            $userFind = self::$user = self::$userClass::findOne([$key => $userId]);
            if(!$userFind){
                return null;
            }
            return $userFind;
        }
        return null;
    }

}