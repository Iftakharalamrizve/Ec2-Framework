<?php

namespace app\core;


abstract class Model
{
    public mixed $mysql;

    public function __construct()
    {
        $this->connection ();
    }

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

    public function connection():void
    {
        $this->mysql = Application::$app->db->mysql instanceof \PDO?Application::$app->db->mysql:null;
    }



}