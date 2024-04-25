<?php

$router->get('/', 'app/controllers/index.php');
$router->get('/about', 'app/controllers/about.php');
$router->get('/contact', 'app/controllers/contact.php');
$router->get('/notes', 'app/controllers/notes/index.php');

$router->get('/note', 'app/controllers/notes/show.php');
$router->delete('/note', 'app/controllers/notes/destroy.php');

$router->get('/note-create', 'app/controllers/notes/create.php');
$router->post('/note-create', 'app/controllers/notes/store.php');

