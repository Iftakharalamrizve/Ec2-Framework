<?php

namespace app\core\DBModel;

interface ORMInterFace
{
    public function save():bool;

    public function create(array $data):array;

    public function update(array $data):array;

    public function delete(array $data):bool;
}