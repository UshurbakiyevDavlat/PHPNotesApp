<?php

use Config\Config;
use Database\Database;
use Validator\Validator;

$data = $_POST;
$body = $data['body'];

$errors = Validator::string($body, 10, 1000);
$config = Config::getConfig();
$statement = 'INSERT INTO notes (body, user_id) VALUES (:body, :user_id)';

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