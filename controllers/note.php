<?php

$heading = 'Note';
$config = Config::env();
$currentUserId = 1;

$queryParams = [
    'id' => $_GET['id'] ?? null
];

$statement = 'SELECT * FROM notes WHERE id = :id'; // write a sql query

$fetchOptions = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // fetch option
];

$db = new Database($config['database'], $statement, $fetchOptions);
$connection = $db->query($queryParams);

$note = $connection->findOrFail(); // fetching all results in associative array format
authorize((int)$note['user_id'] !== $currentUserId);

require 'views/note.view.php';