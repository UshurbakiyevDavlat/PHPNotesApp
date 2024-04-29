<?php

if (!isset($router)) {
    die('Router has not set properly!');
}

$router->get('/', 'app/controllers/index.php');
$router->get('/about', 'app/controllers/about.php');
$router->get('/contact', 'app/controllers/contact.php');

$router->get('/notes', 'app/controllers/notes/index.php')->only('auth');

$router->get('/note', 'app/controllers/notes/show.php')->only('auth');
$router->delete('/note', 'app/controllers/notes/destroy.php')->only('auth');

$router->get('/note-create', 'app/controllers/notes/create.php')->only('auth');
$router->post('/note-create', 'app/controllers/notes/store.php')->only('auth');

$router->get('/note-edit', 'app/controllers/notes/edit.php')->only('auth');
$router->patch('/note-edit', 'app/controllers/notes/update.php')->only('auth');

//TODO need  to make group route functionality

$router->get('/registration','app/controllers/auth/register/create.php')->only('guest');
$router->post('/registration','app/controllers/auth/register/store.php')->only('guest');

$router->get('/login', 'app/controllers/auth/session/create.php')->only('guest');
$router->post('/session', 'app/controllers/auth/session/store.php')->only('guest');
$router->delete('/session', 'app/controllers/auth/session/destroy.php')->only('auth');