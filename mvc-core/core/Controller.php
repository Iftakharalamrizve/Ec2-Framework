<?php

namespace app\core;

class Controller
{
    public String $layout = 'layout';
    public array $errors = [] ;
    public bool $withInput = false;

    public function render($baseLayout = 'layout', $name,$params=[])
    {
        $this->layout = $baseLayout ;
        return Application::$app->router->renderView( $name,$params);
    }

    public function setLayout($name='layout',$param=[])
    {
        $this->layout = $name ;
    }

    public function withErrors(array $errors = [])
    {
        $this->errors = $errors;
        return $this;
    }

    public function withInputs()
    {
        $this->withInput = true ;
        return $this;
    }

}