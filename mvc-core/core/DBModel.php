<?php

namespace app\core;

class DBModel extends Model
{

    /**
     * @var array
     */
    public array $fillableData = [];



    public function __set($propertyName , $value)
    {
        $this->fillableData[$propertyName] = $value;
    }

    public function __get($name)
    {
        if(array_key_exists ( $name , $this->fillableData)) {
            return $this->fillableData[$name];
        }
    }

    /**
     * Load All Request data from user input
     * Load
     * @param $data
     */
    public function loadUserData( $data)
    {
        foreach ($data as $key=>$value) {
            if(in_array($key,$this->fillable)) {
                $this->{$key}= $value ;
            }
        }
    }
}