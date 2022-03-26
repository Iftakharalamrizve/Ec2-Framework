<?php

namespace app\core\DBModel;

use app\core\Application;
use PDO;

trait ORMTrait
{
    public function save():bool
    {
        $dbTable = $this->table;
        $attributes =$this->fillable;
        $params = array_map(fn($attr) => ":$attr" ,$attributes);
        $statement = Application::$app->db->prepare("INSERT INTO $dbTable (" . implode(",", $attributes) . ") VALUES (" . implode(",", $params) . ")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public function create(array $data =[]):array
    {
        return [];
    }

    public function update(array $data =[]):array
    {
        return [];
    }

    public function delete(array $data =[]):bool
    {
        return true;
    }

    public  function findOne($where)
    {

        $tableName =$this->table;
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

}