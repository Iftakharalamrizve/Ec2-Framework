<?php

namespace app\core;

class Response
{
    public function setStatusCode($code):void
    {
        http_response_code($code);
    }
}