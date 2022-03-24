<?php

namespace app\core;

class DBModel extends Model
{

    /**
     * @var array
     */
    public array $attributes = [];



    public function __set($propertyName , $value)
    {
        $this->attributes[$propertyName] = $value;
    }

    public function __get($name)
    {
        if(array_key_exists ( $name , $this->attributes)) {
            return $this->attributes[$name];
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
                $status = $this->haveAnyMutators($key);
                if(!$status){
                    $this->{$key}= $value ;
                }

            }
        }
        dd($this->attributes);
    }

    public function haveAnyMutators($key) : bool
    {

        $functionName = 'set'.str_replace(' ','',ucwords(str_replace ( '_' , ' ' , $key))).'Attribute';
        if (method_exists(get_parent_class($this), $functionName)) {
            parent::$functionName();
            return true;
        }
        return false;
    }
}