<?php

namespace app\middleware;

use app\core\auth\Auth;
use app\core\Middleware;
use app\core\Request;

class AuthMiddleware extends Middleware
{
    public function handle ( Request $request )
    {
        if(Auth::isGuest()){
            return $request->redirect ( '/login');
        }


    }
}