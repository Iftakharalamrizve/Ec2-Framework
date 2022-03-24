<?php

namespace app\models;

use app\core\DBModel;

class User  extends DBModel
{
    public $fillable = ['first_name','last_name','email','password'];
    public $table = 'users';




    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash ( $value , PASSWORD_DEFAULT );

    }




}