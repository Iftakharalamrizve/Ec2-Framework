<?php

namespace app\core;


abstract class Model
{
    /**
     * Load All Request data from user input
     * Load
     * @param $data
     */
    public function loadUserData( $data)
    {
        foreach ($data as $key=>$value){
            if(property_exists($this,$key)){
                $this->{$key} = $value ;
            }
        }
    }



}