<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [ // catching at index.php level
    'email' => $_POST['email'],
    'password' => $_POST['password'],
]);

$signedIn = (new Authenticator())->attempt($attributes['email'], $attributes['password']);

if (!$signedIn) {
    $form->error(
        'user_not_found',
        'There are no match with these credentials in the system, 
        please provide correct email and password'
    )->throw(); // Catching at index.php level
}

redirect('/');