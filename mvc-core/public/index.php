<?php
error_reporting(E_ALL);
require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\ContactController;
use app\controllers\HomeController;
use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/',[HomeController::class,'index']);
$app->router->get('/contact',[ContactController::class,'index']);
$app->router->post('/contact',[ContactController::class,'save']);
//Register and login route
$app->router->get('/register',[AuthController::class,'register']);
$app->router->post('/register',[AuthController::class,'register']);
$app->router->get('/login',[AuthController::class,'login']);
$app->router->post('/login',[AuthController::class,'login']);

$app->run();