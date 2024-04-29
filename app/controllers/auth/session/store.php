<?php

use Core\App;
use Core\Database;
use Core\Validator;

$errors = [];
$email = $_POST['email'];
$password = $_POST['password'];

$emailValidator = Validator::email($email);
$passwordValidator = Validator::string($password);

try {
    $db = App::resolve(Database::class);
} catch (Exception $e) {
    die($e->getMessage());
}

// validate email and password

if (!$emailValidator) {
    //validate email
    $errors['email'] = 'Please provide valid email';
}

if (!empty($passwordValidator['errors'])) {
    //validate password
    $errors['password'] = 'Please provide valid password';
}

if (!empty($errors)) {
    // if there are any errors send user back to view with errors
    return view('/auth/session/create', [
        'errors' => $errors,
    ]);
}

// get user with that email in system password hash
$user = $db->query('SELECT * FROM users where email=:email', ['email' => $email])->first();

// if user has found
if ($user) {
    // check that system has matched a pair of those email and password that are given, verify password.
    if (password_verify($password, $user['password'])) {
        // log in user
        login($email);
        // then send user to main page
        header('Location: /');
        exit();
    }
}

//if user has not found then send back to login page with error

$errors['additional'] = 'There are no match with these credentials in the system, please provide correct email and password';

return view('auth/session/create', compact('errors'));