<?php

namespace app\core;

class Response
{
    /**
     * Set Request Http code
     * @param $code
     */
    public function setStatusCode( $code):void
    {
        http_response_code($code);
    }
}