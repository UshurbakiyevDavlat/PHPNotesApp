<?php

namespace App\Core;

use Exception;
use PDO;
use PDOStatement;

class Database
{
    private PDOStatement $prepared;
    private PDO $pdo;

    /**
     * @throws Exception
     */
    public function __construct(
        array  $config,
        string $username = 'root',
        string $password = 'root',
        array  $fetchOptions = null,
    )
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';'); // data to connect for mysql
        try {
            $this->pdo = new PDO($dsn, $username, $password, $fetchOptions); // make an instance of pdo that connect us to mysql
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Executive query method
     *
     * @param string $statement
     * @param array $params
     * @return $this
     */
    public function query(string $statement, array $params): Database
    {
        // connection to Mysql by PDO

        $this->prepared = $this->pdo->prepare($statement); // prepare and execute query with help of pdo
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
     * @return array
     */
    public function findOrFail(): array
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
     * First collection method
     *
     * @return bool|array
     */
    public function first(): bool|array
    {
        return $this->find()->fetch();
    }
}
