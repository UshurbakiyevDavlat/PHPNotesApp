<?php

use Helpers\Router\Router;

const BASE_PATH = __DIR__ . '/../';

(new App\Controller\DotEnvEnvironment)->load(BASE_PATH);

require BASE_PATH . 'helpers/functions.php';

spl_autoload_register(static function ($class) {
    $namespace = explode('\\', $class);
    $class = strtolower(str_replace(['\\'], ['/'], array_pop($namespace)));

    // Define the directories to search for classes
    $directories = [
        'helpers',
        'routes',
        'config',
        'database',
        'app/enums'
    ];

    foreach ($directories as $directory) {
        $path = BASE_PATH . $directory . '/' . $class . '.php';
        if (file_exists($path)) {
            require $path;
            break;
        }
    }
});

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

