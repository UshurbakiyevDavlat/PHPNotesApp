<?php

$config = Config::env();
$statement = 'INSERT INTO notes (body, user_id) VALUES (:body, :user_id)';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $data = $_POST;
    $body = trim($data['body']);

    if (empty($body)) {
        $errors [] = 'The note body is required.';
    }

    if (strlen($body) < 10) {
        $errors[] = 'The note body must be at least 10 characters. You have entered ' . strlen($body) . ' characters.';
    }

    if (strlen($body) > 1000) {
        $errors[] = 'The note body must be less than 1000 characters.';
    }

    if (empty($errors)) {
        $query_params = [
            'body' => $body,
            'user_id' => 1
        ];

        $db = new Database($config['database'], $statement);
        try {
            $db->query($query_params);
            $result = 'Note created successfully.';
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

require 'views/note-create.view.php';
