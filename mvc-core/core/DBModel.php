<?php

namespace app\core;

class DBModel extends Model
{

    /**
     * @var array
     */
    public array $fillableData = [];

    /**
     * Load All Request data from user input
     * Load
     * @param $data
     */
    public function loadUserData( $data)
    {
        foreach ($data as $key=>$value){
            if(in_array($key,$this->fillable)){
                $this->fillableData[ $key] = $value ;
            }
        }
    }
}