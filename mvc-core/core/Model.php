<?php

namespace app\core;


abstract class Model
{


    public function loadUserData($data)
    {
        foreach ($data as $key=>$value){
            if(property_exists($this,$key)){
                $this->{$key} = $value ;
            }
        }
    }



}