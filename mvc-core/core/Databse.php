<?php

namespace app\core;
use PDO;

class Databse
{
    public PDO $pdo;

     /**
     * Mysql Public database connection
     * @var string
     */
    public \PDO $mysql ;

    /**
     * @todo need extend database connection
     * @param array $config
     */
    public function __construct( array $config)
    {

        if($config['mysql']??false){
            try {
                $config = $config['mysql'];
                $dsn = $config['driver'].':host='.$config['host'].';port='.$config['port'].';dbname='.$config['database'];
                $user = $config['username'];
                $password = $config['password'];
                $this->mysql = new PDO($dsn, $user, $password);
                $this->mysql->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
            }
        }

    }

    public function applyMigration()
    {
        $this->createMigrationTable ();
    }


    public function createMigrationTable()
    {
        $this->mysql->exec ( "CREATE TABLE IF NOT  EXISTS migrations(
                                id INT AUTO_INCREMENT PRIMARY KEY ,
                                migrations VARCHAR(255),
                                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                            ) ENGINE=INNODB;");
    }
}