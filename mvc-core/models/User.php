<?php

namespace app\models;

use app\core\DBModel;

class User  extends DBModel
{
    public $fillable = ['first_name','last_name','email','password'];
    public $table = 'users';






}