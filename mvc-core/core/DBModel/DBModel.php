<?php

namespace app\core\DBModel;

use app\core\Model;

abstract class DBModel extends Model  implements  ORMInterFace
{
    use ORMTrait;

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
                $status = $this->haveAnyMutators($key,$value);
                if(!$status){
                    $this->{$key}= $value ;
                }

            }
        }

    }

    public function haveAnyMutators($key,$value) : bool
    {
        $functionName = 'set'.str_replace(' ','',ucwords(str_replace ( '_' , ' ' , $key))).'Attribute';
          if(method_exists($this,$functionName)){
              $this->{$functionName}($value);
              return true;
          }
        return false;
    }
}