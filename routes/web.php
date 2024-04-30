<?php

if (!isset($router)) {
    die('Router has not set properly!');
}

$router->get('/', '/index.php');
$router->get('/about', '/about.php');
$router->get('/contact', '/contact.php');

$router->get('/notes', '/notes/index.php')->only('auth');

$router->get('/note', '/notes/show.php')->only('auth');
$router->delete('/note', '/notes/destroy.php')->only('auth');

$router->get('/note-create', '/notes/create.php')->only('auth');
$router->post('/note-create', '/notes/store.php')->only('auth');

$router->get('/note-edit', '/notes/edit.php')->only('auth');
$router->patch('/note-edit', '/notes/update.php')->only('auth');

//TODO need  to make group route functionality

$router->get('/registration','/auth/register/create.php')->only('guest');
$router->post('/registration','/auth/register/store.php')->only('guest');

$router->get('/login', '/auth/session/create.php')->only('guest');
$router->post('/session', '/auth/session/store.php')->only('guest');
$router->delete('/session', '/auth/session/destroy.php')->only('auth');