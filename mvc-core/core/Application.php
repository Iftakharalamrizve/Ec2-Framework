<?php

namespace app\core;
use app\core\router\Router;

class Application
{

    /**
     * The application instance store this property .
     *
     * @var \app\core\Application
     */
    public static Application $app;

    /**
     * The Root Directory in this application.
     *
     * @var string
     */
    public static string $ROOT_DIR;

    /**
     * The application instance store this property .
     *
     * @var Router
     */
    public Router $router;

    /**
     * The application instance store this property .
     *
     * @var \app\core\Response
     */
    public Response $response;

    /**
     * The application instance store this property .
     *
     * @var \app\core\Request
     */
    public Request $request;

    /**
     * The application instance store this property .
     *
     * @var Session
     */
    public Session $session;

    /**
     * The application instance store this property .
     *
     * @var Databse
     */
    public Databse $db;
    

    /**
     * The application instance store this property .
     *
     * @var \app\core\Controller
     */
    public Controller $controller;

    /**
     * Create a new  Application class instance for full framework example Application::$app.
     * Create Request and Response class instance
     * Create New router instance and pass Request and Response class
     *
     * @param string $dirName
     */
    public function __construct(string $dirName, array $config)
    {
        self::$ROOT_DIR = $dirName;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router( $this->request , $this->response );
        $this->db = new Databse($config['database']);
        $this->session = new Session();

    }

    /**
     * Flush Router operation user run method .
     *
     * @return void
     */

    public function run():void
    {
        echo $this->router->resolve();
    }

}