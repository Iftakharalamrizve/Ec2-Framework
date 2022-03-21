<?php

namespace app\core;
use app\core\router\Router;

class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Response $response;
    public Request $request;
    public static Application $app;
    public Controller $controller;

    public function __construct(string $dirName)
    {
        self::$ROOT_DIR = $dirName;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router( $this->request , $this->response );
    }

    public function run()
    {
        echo $this->router->resolve();
    }

}