<?php

namespace app\models;

use app\core\DBModel;

class User  extends DBModel
{
    protected $fillable = ['first_name','last_name','email','password'];
    protected $table = 'users';

}