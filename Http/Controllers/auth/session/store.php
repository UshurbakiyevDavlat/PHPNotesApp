<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
$form->validate($email, $password);

if (empty($form->errors())) {
    if ((new Authenticator())->attempt($email, $password)) {
        redirect('/');
    }
}

$form->error(
    'user_not_found',
    'There are no match with these credentials in the system, please provide correct email and password'
);

Session::flash('errors', $form->errors());
Session::flash('old',
    [
        'email' => $email,
    ]
);

redirect('/login');