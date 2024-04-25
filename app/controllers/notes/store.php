<?php

use Config\Config;
use Database\Database;
use Validator\Validator;

$body = $_POST['body'];

$errors = Validator::string($body, 10, 1000);
$statement = 'INSERT INTO notes (body, user_id) VALUES (:body, :user_id)';

if ($errors['errors'] === '') {
    $query_params = [
        'body' => $body,
        'user_id' => 1
    ];

    $db = new Database(Config::getConfig()['database'], $statement);

    try {
        $db->query($query_params);
        $result = 'Note created successfully.';
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

return view('notes/create', compact('errors', 'body'));