<?php

namespace app\models;

use app\core\Model;

class User extends Model
{
    protected $attribute = ['first_name','last_name','email','password'];
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password'];
    }

    public function createUser(){

    }
}