<?php

error_reporting(E_ALL);
ini_set('display_errors',1);
define('APPLICATION_PATH',substr(realpath(dirname(__FILE__)),0,-6));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
|Composer Autoload loaded automatically generated class loader for
|our application. We can use this tricks . We only require autoload file .
|
*/

require __DIR__.'/../vendor/autoload.php';


/*
|--------------------------------------------------------------------------
| Configure Error File
|--------------------------------------------------------------------------
|
|Error File load all error in development mode .
|Error Handle Exception and other type error manage this file .
|
*/






