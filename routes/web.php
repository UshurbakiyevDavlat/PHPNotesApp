<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => '../app/controllers/index.php',
    '/about' => '../app/controllers/about.php',
    '/contact' => '../app/controllers/contact.php',
    '/notes' => '../app/controllers/notes/index.php',
    '/note' => '../app/controllers/notes/show.php',
    '/note-create' => '../app/controllers/notes/create.php',
];

routeToController($uri, $routes);
