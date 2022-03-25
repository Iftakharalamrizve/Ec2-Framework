<?php

namespace app\models;

use app\core\DBModel\DBModel;

class User  extends DBModel
{
    public $fillable = ['first_name','last_name','email','password'];
    public $table = 'users';

    public function userSave()
    {

    }

    /**
     * @param $value
     * @return void
     */
    public function setPasswordAttribute($value):void
    {
        $this->attributes['password'] = password_hash ( $value , PASSWORD_DEFAULT );

    }

}