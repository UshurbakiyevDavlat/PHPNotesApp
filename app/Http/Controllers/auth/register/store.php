<?php

use app\Core\App;
use app\Core\Database;
use app\Core\Session;
use app\Http\Forms\RegisterForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new RegisterForm();
$form->validate($email, $password);

if (empty($form->errors())) {
    try {
        $db = App::resolve(Database::class);
    } catch (Exception $e) {
        die($e->getMessage());
    }

    $user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->first();

    if ($user) {
        redirect('/login');
    }

    $db->query('INSERT INTO users (email,password) VALUES (:email,:password)',
        [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), //for now default is BCRYPT
        ],
    );

    login($email);
    redirect('/');
}

Session::flash('errors', $form->errors());
redirect('/registration');
