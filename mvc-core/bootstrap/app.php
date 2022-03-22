<?php

use app\core\Application;

require_once __DIR__.'/../vendor/autoload.php';
$app = new Application(dirname(__DIR__));



$baseDir=scandir(dirname(__DIR__).'/routes');
$allRoutes=array_diff($baseDir,['.','..']);

foreach($allRoutes as $route)
{   $router=$app->router;
    require __DIR__.'/../routes/'.$route;
}

return $app;