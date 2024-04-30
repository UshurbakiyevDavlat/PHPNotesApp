<?php

use App\Services\AuthService;
use Core\App;
use Core\Database;
use Core\Validator;

$body = $_POST['body'];

$result = null;
$errors = Validator::string($body, 10, 1000);
$statement = 'INSERT INTO notes (body, user_id) VALUES (:body, :user_id)';
$user = (new AuthService())->getAuthenticatedUser();

if (!$user) {
    die('User in your session is not legit in database.');
}

if (empty($errors)) {
    $query_params = [
        'body' => $body,
        'user_id' => $user['id'],
    ];

    try {
        $db = App::resolve(Database::class);
        $db->query($statement, $query_params);
        $result = 'Note created successfully.';
    } catch (Exception|PDOException $e) {
        die($e->getMessage());
    }

}
//TODO need to make redirection to notes index, with flash messages functionality
return view('notes/create', compact('errors', 'body', 'result'));