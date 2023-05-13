<?php

$config = Config::env();
$statement = 'INSERT INTO notes (body, user_id) VALUES (:body, :user_id)';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query_params = [
        'body' => $_POST['body'],
        'user_id' => 1
    ];

    $db = new Database($config['database'], $statement);

    $db->query($query_params)->find();
}

require 'views/note-create.view.php';
