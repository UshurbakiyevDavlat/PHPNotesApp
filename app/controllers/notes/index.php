<?php

use Core\App;
use Core\Database;

$heading = 'Notes';
$currentUserId = 1;

$queryParams = [
    'user' => $currentUserId
];

$statement = 'SELECT * FROM notes where user_id = :user '; // write a sql query

try {
    $db = App::resolve(Database::class);
    $connection = $db->query($statement, $queryParams);
    $notes = $connection->get();
} catch (Exception $e) {
    die($e->getMessage());
}

return view('notes/index', compact('heading', 'notes'));
