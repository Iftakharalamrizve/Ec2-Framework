<?php

namespace App\Console;

class Kernel
{
    public function commands()
    {
        $path    = '/Commands/';
        $files = array_diff(scandir('.'.$path), array('.', '..'));
        foreach ($files as $file){
//            echo __DIR__.$path.$file;
            echo  APPLICATION_PATH;
        }

    }
}
$obj = new Kernel;
$obj->commands();