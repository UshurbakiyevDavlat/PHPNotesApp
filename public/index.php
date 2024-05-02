<?php

use App\Core\Router;
use App\Core\Session;
use App\Core\ValidationException;
use App\Http\Controllers\DotEnvEnvironment;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . '/bootstrap.php';
require BASE_PATH . 'app/Core/functions.php';

session_start();

(new DotEnvEnvironment)->load(BASE_PATH);

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

