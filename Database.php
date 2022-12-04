<?php

class Database
{
    private $statement;
    private $pdo;

    public function __construct($config, $statement,$fetchOptions ,$username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';'); // data to connect for mysql
        $this->statement = $statement; // query initialization
        $this->pdo = new PDO($dsn, $username, $password, $fetchOptions ); // make an instance of pdo that connect us to mysql
    }

    public function query($params)
    {
        // connection to Mysql by PDO

        $statement = $this->pdo->prepare($this->statement); // prepare and execute query with help of pdo
        $statement->execute($params);

        return $statement;
    }
}