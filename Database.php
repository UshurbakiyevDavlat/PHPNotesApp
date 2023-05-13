<?php

class Database
{
    private $statement;
    private $pdo;

    public function __construct($config, $statement, $fetchOptions = null, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';'); // data to connect for mysql
        $this->statement = $statement; // query initialization
        $this->pdo = new PDO($dsn, $username, $password, $fetchOptions); // make an instance of pdo that connect us to mysql
    }

    public function query($params): Database
    {
        // connection to Mysql by PDO

        $this->statement = $this->pdo->prepare($this->statement); // prepare and execute query with help of pdo
        $this->statement->execute($params);

        return $this;
    }

    public function find()
    {
        return $this->statement;
    }

    public function findOrFail()
    {
        $result = $this->statement->fetch();

        if (!$result) {
            abort();
        }

        return $result;
    }

    public function get()
    {
        return $this->find()->fetchAll();
    }
}
