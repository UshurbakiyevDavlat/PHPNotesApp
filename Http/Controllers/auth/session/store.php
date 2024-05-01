<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$errors = [];
$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
$form->validate($email, $password);

if (empty($errors)) {
    if ((new Authenticator())->attempt($email, $password)) {
        redirect('/');
    }

    $form->error(
        'user_not_found',
        'There are no match with these credentials in the system, please provide correct email and password'
    );
}

return view('auth/session/create', compact('errors'));