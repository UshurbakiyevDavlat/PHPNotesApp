<?php

session_start();

use Core\Router;
use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . '/../';

require '../autoload.php';
require '../bootstrap.php';
require BASE_PATH . 'Core/functions.php';

(new Http\Controllers\DotEnvEnvironment)->load(BASE_PATH);

$uri = trim(
    str_replace(
        '/public',
        '',
        parse_url($_SERVER['REQUEST_URI'])['path']
    ),
    ' '
);

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router = new Router();

require base_path('routes/web.php');

try {
    $router->route($uri, $method);
    Session::unflash();
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', ['email' => $exception->old['email']]);
    redirect(previousUrl());
}

