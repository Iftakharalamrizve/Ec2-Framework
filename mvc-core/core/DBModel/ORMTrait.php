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

}