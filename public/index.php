<?php

use Core\Router;

const BASE_PATH = __DIR__ . '/../';

require '../autoload.php';
require '../bootstrap.php';
require BASE_PATH . 'core/functions.php';

(new App\Controller\DotEnvEnvironment)->load(BASE_PATH);

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
} catch (Exception $exception) {
    error_reporting(1);
    die($exception->getMessage());
}

