<?php

use Core\App;
use Core\Database;
use Http\Forms\RegisterForm;

$errors = [];
$email = $_POST['email'];
$password = $_POST['password'];

$form = new RegisterForm();
$form->validate($email, $password);

if (empty($errors)) {
    try {
        $db = App::resolve(Database::class);
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->first();

    if ($user) {
        redirect('/login');
    } else {
        $db->query('INSERT INTO users (email,password) VALUES (:email,:password)',
            [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT), //for now default is BCRYPT
            ],
        );

        login($email);
        redirect('/');
    }
}

return view('auth/registration/create', [
    'errors' => $form->errors(),
]);
