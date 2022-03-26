<?php

namespace app\core\auth;

use app\core\Application;
use app\core\DBModel\DBModel;

class Auth
{
    protected static $user;
    protected  static $session;
    protected static $dbClass;

    public function __construct()
    {
        $this->session = Application::$app->session;
    }

    public static function login(DBModel $user)
    {
        self::$user = $user;
        $primaryKey = $user->primaryKey();
        $primaryKeyValue = $user->{$primaryKey};
        self::$session->set('user',$primaryKeyValue);

    }

    public static function logout()
    {
        self::$user = null;
        self::$session->remove('user');
    }

    public static function user()
    {
        $userId = self::$session->get('user');
        if ($userId) {
            $key = self::$dbClass->primaryKey();
            self::$user = self::$dbClass::findOne([$key => $userId]);
        }
    }

}