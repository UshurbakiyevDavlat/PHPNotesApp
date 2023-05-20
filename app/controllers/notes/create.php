<?php

require(__DIR__ .'/../../../helpers/Validator.php');

$config = Config::env();
$statement = 'INSERT INTO notes (body, user_id) VALUES (:body, :user_id)';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $data = $_POST;
    $body = $data['body'];

    $errors = Validator::string($body, 10, 1000);

    if ($errors['errors'] === '') {
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

require __DIR__ . '/../../../resources/views/notes/create.view.php';
