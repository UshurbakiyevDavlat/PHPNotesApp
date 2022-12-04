<?php

require 'functions.php';
require 'router.php';
require 'Database.php';
require 'Config.php';

$config = Config::env();


$queryParams = [
    'id' => $_GET['id'] ?? null
];

$statement = 'SELECT * FROM posts WHERE id = :id'; // write a sql query

$fetchOptions = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // fetch option
];

$db = new Database($config['database'], $statement, $fetchOptions);
$connection = $db->query($queryParams);

$post = $connection->fetch(); // fetching all results in associative array format

dd($post);