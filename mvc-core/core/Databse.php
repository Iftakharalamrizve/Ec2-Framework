<?php

namespace app\core;

class Databse
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = 1 ;
        $user = 1 ;
        $password = 1 ;

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    }
}