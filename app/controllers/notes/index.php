<?php

use Config\Config;
use Database\Database;

$heading = 'Notes';
$currentUserId = 1;

$queryParams = [
    'user' => $currentUserId
];

$statement = 'SELECT * FROM notes where user_id = :user '; // write a sql query

$fetchOptions = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // fetch option
];

try {
    $db = new Database(Config::getConfig()['database'], $statement, $fetchOptions);
    $connection = $db->query($queryParams);
    $notes = $connection->get();
} catch (Exception $e) {
    die($e->getMessage());
}

return view('notes/index', compact('heading', 'notes'));
