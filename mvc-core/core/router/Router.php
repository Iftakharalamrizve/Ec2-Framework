<?php

namespace app\core\router;


use app\core\Application;
use app\core\Request;
use app\core\Response;

class Router
{
    public Request $request;
    private Response $response;
    private array $routes = [];

    public function __construct(Request $request , Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    final public function get( String $path,  $callback):void
    {
        $this->routes['get'][$path] = $callback;
    }
    final public function post( String $path,  $callback):void
    {
        $this->routes['post'][$path] = $callback;
    }


    /**
     * @return mixed
     */
    final public function  resolve()
    {
       $path = $this->request->getPath();
       $method = $this->request->getMethod();
       $callback = $this->routes[$method][$path] ?? false;
       if($callback === false){
           $this->response->setStatusCode(404);
           return $this->errorLayoutLoad(404);
       }

       if(is_string($callback)){
            return $this->renderView($callback);
       }

       if(is_array($callback)){
           Application::$app->controller = new $callback[0]() ;
           $callback[0] = Application::$app->controller;
       }

       return  call_user_func($callback,$this->request);
    
    }

    final public function renderView( String $view , $params = [])
    {
        $layoutView = $this->layoutView();
        $loadContentView = $this->layoutContentView($view , $params);
        return str_replace('{{content}}',$loadContentView,$layoutView) ;
    }

    final public function layoutView()
    {
        $name = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$name.php";
        return ob_get_clean();
    }

    final public function layoutContentView($view , $params)
    {


        $request = Application::$app->request;
        $request->errors = Application::$app->controller->errors;
        foreach ($params as $key=>$value){
            $$key = $value ;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }

    final public function errorLayoutLoad($code)
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/errors/$code.php";
        return ob_get_clean();
    }
}