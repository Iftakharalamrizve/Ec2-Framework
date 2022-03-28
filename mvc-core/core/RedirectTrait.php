<?php

namespace app\core;

trait RedirectTrait
{

    public function redirect($url)
    {
        return Application::$app->response->redirect($url);
    }

}