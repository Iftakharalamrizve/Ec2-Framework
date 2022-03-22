<?php

use app\controllers\AuthController;

$router->get( '/register', [ AuthController::class , 'register']);
$router->post('/register',[AuthController::class,'register']);
$router->get('/login',[AuthController::class,'login']);
$router->post('/login',[AuthController::class,'login']);