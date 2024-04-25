<?php

namespace Database;

use PDO;
use PDOStatement;

class Database
{
    private string $statement;
    private PDOStatement $prepared;
    private PDO $pdo;

    public function __construct(
        $config,
        $statement,
        $fetchOptions = null,
        $username = 'root',
        $password = '',
    )
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';'); // data to connect for mysql
        $this->statement = $statement; // query initialization
        $this->pdo = new PDO($dsn, $username, $password, $fetchOptions); // make an instance of pdo that connect us to mysql
    }

    /**
     * Executive query method
     *
     * @param $params
     * @return $this
     */
    public function query($params): Database
    {
        // connection to Mysql by PDO

        $this->prepared = $this->pdo->prepare($this->statement); // prepare and execute query with help of pdo
        $this->prepared->execute($params);

        return $this;
    }

    /**
     * Find record method
     *
     * @return PDOStatement
     */
    public function find(): PDOStatement
    {
        return $this->prepared;
    }

    /**
     * Find record or fail
     *
     * @return mixed
     */
    public function findOrFail(): mixed
    {
        $result = $this->prepared->fetch();

        if (!$result) {
            abort();
        }

        return $result;
    }

    /**
     * Get collection method
     *
     * @return bool|array
     */
    public function get(): bool|array
    {
        return $this->find()->fetchAll();
    }

    /**
     * Execute db query method
     *
     * @param $config
     * @param $statement
     * @param $queryParams
     * @return Database
     */
    public static function execute($config, $statement, $queryParams): Database
    {
        $fetchOptions = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // fetch option
        ];
        return (new Database($config['database'], $statement, $fetchOptions))->query($queryParams);
    }
}
