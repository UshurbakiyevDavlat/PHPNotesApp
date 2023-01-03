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

$note = $connection->fetch(); // fetching all results in associative array format

if (!$note) {
    abort();
}

if ($note['user_id'] != $currentUserId) {
    abort(Response::FORBIDDEN);
}

require 'views/note.view.php';