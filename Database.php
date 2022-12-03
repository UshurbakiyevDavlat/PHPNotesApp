<?php

class Database
{
    private $statement;
    private $dsn;
    private $username;
    private $password;
    private $fetchOptions;

    public function __construct($config, $statement,$fetchOptions ,$username = 'root', $password = '')
    {
        $this->dsn = 'mysql:' . http_build_query($config, '', ';'); // data to connect for mysql
        $this->username = $username; //username data
        $this->password = $password; //password data
        $this->statement = $statement; // query initialization
        $this->fetchOptions = $fetchOptions; // fetch options
    }

    public function query()
    {
        // connection to Mysql by PDO, will be refactored, but for first lesson let it go this way

        $pdo = new PDO($this->dsn, $this->username, $this->password, $this->fetchOptions ); // make an instance of pdo that connect us to mysql

        return $pdo->query($this->statement); // prepare and execute query with help of pdo
    }
}