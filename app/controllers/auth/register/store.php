<?php

use Core\App;
use Core\Database;
use Core\Validator;

//initialize parameters
$errors = [];
$email = $_POST['email'];
$password = $_POST['password'];

try {
    $db = App::resolve(Database::class);
} catch (Exception $e) {
    die($e->getMessage());
}

$emailValidator = Validator::email($email);
$passwordValidator = Validator::string($password, 7);

// validate credentials
if (!$emailValidator) {
    // validate email
    $errors['email'] = 'Please provide correct email address';
}
if (!empty($passwordValidator['errors'])) {
    // validate password 7 min and 255 max chars
    $errors['password'] = 'Password should be min 7 and max 255 characters';
}

if (!empty($errors)) {
    return view('auth/registration/create', [
        'errors' => $errors,
    ]);
}

// check if there is a user with this email
$user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->first();

if ($user) {
    //if yes then send him to login page
    header('Location: /'); //TODO redirect to login
    exit();
} else {
//if no then create account, login him and send to index page
    $db->query('INSERT INTO users (email,password) VALUES (:email,:password)',
        [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), //for now default is BCRYPT
        ],
    );

    $_SESSION['user'] = [
        'email' => $email,
    ];

    header('Location: /');
    exit();
}