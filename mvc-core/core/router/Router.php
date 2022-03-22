<?php

namespace app\core\router;

use app\core\Application;
use app\core\Request;
use app\core\Response;

class Router
{
    /**
     * The property  store request instance  this property .
     *
     * @var \app\core\Request
     */
    public Request $request;

    /**
     * The property  store response instance  this property .
     *
     * @var \app\core\Response
     */
    private Response $response;

    /**
     * The property use for store all route list
     *
     * @var array
     */
    private array $routes = [];

    /**
     * Assign Request and Response class instance in this class property
     *
     * @param \app\core\Request  $request
     * @param \app\core\Response $response
     */

    public function __construct(Request $request , Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    /**
     * Receive Route get method path and callback
     * Path example : /home . /contact
     * This Method get only get request from route
     * Callback example : [ControllerName::class,'methodName']
     *
     * @param String $path
     * @param        $callback
     */
    final public function get( String $path, $callback):void
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Receive Route get method path and callback
     * Path example : /home . /contact
     * This Method get only post request from route
     * Callback example : [ControllerName::class,'methodName']
     *
     * @param String $path
     * @param        $callback
     */

    final public function post( String $path,  $callback):void
    {
        $this->routes['post'][$path] = $callback;
    }


    /**
     * Get Request Path and Method
     * Path example = '/home' and Method Example : index
     * Callback call from routes array use method and path key
     * If callback not found in routes array then return 404 error
     * if callback is string then direct return render and load page
     * if call back is array then it has controller and method
     * Note : Operation perform depend on controller and method name and load file
     *
     * @return mixed
     */
    final public function  resolve(): string
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


    /**
     * This method return main layout after formation
     *
     * @param String $view
     * @param array  $params
     * @return array|bool|string
     */
    final public function renderView( string $view , array $params = [])
    {
        $layoutView = $this->layoutView();
        $loadContentView = $this->layoutContentView($view , $params);
        return str_replace('{{content}}',$loadContentView,$layoutView) ;
    }


    /**
     * This method create view layout which one user want to append
     *
     * @return false|string
     */
    final public function layoutView()
    {
        $name = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$name.php";
        return ob_get_clean();
    }


    /**
     * This method create main layout which layout user want to append
     *
     * @param $view
     * @param $params
     * @return false|string
     */
    final public function layoutContentView( $view , $params)
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

    /**
     * This method show error layout
     *
     * @param $code
     * @return false|string
     */
    final public function errorLayoutLoad( $code)
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/errors/$code.php";
        return ob_get_clean();
    }
}