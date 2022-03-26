<?php

namespace app\core;



class Controller
{
    use RenderTrait;
    /**
     * @var string
     */
    public String $layout = 'layout';

    /**
     * @var array
     */
    public array $errors = [] ;

    /**
     * @var bool
     */
    public bool $withInput = false;



}