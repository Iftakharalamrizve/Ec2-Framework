<?php
use app\controllers\AuthController;
use app\controllers\ContactController;
use app\controllers\HomeController;
use app\core\Application;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));

$baseDir=scandir(base_path('routes'));
$allRoutes=array_diff($baseDir,['.','..']);




return $app;