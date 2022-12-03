<?php

class Database
{
    public $query;
    public $dsn;
    public $username;

    public function __construct($query) {
        $this->dsn = 'mysql:host=localhost;port=3306;dbname=php_native_lessons;charset=utf8mb4'; // data to connect for mysql
        $this->username = 'root'; //username data
        $this->query = $query; // query initialization
    }
    public function query () {
        // connection to Mysql by PDO, will be refactored, but for first lesson let it go this way

        $pdo = new PDO($this->dsn,$this->username); // make an instance of pdo that connect us to mysql
        $statement = $pdo->query($this->query); // prepare and execute query with help of pdo

        return $statement;
    }
}