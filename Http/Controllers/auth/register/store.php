<?php

use Core\App;
use Core\Database;
use Http\Forms\RegisterForm;

//initialize parameters
$errors = [];
$email = $_POST['email'];
$password = $_POST['password'];

$form = new RegisterForm();
$form->validate($email, $password);

if (!empty($errors)) {
    return view('auth/registration/create', [
        'errors' => $form->errors(),
    ]);
}

try {
    $db = App::resolve(Database::class);
} catch (Exception $e) {
    die($e->getMessage());
}

// check if there is a user with this email
$user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->first();

if ($user) {
    //if yes then send him to login page
    header('Location: /login'); //TODO redirect to login
} else {
//if no then create account, login him and send to index page
    $db->query('INSERT INTO users (email,password) VALUES (:email,:password)',
        [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), //for now default is BCRYPT
        ],
    );

    login($email);
    header('Location: /');
}

exit();