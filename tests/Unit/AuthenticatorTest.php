<?php

use App\Core\Authenticator;

init();

it('can login', function () {
    $email = 'email@example@.com';
    (new Authenticator())->login($email);
    expect($_SESSION['user']['email'])->toEqual($email);
});

it('can logout', function () {
    (new Authenticator())->logout();
    expect($_SESSION['user'] ?? null)->toBeNull();
});