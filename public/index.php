<?php

use Helpers\Router\Router;

const BASE_PATH = __DIR__ . '/../';

spl_autoload_register(static function ($class) {
    // Replace backslashes with forward slashes
    $namespace = explode('\\', $class);
    $class = array_pop($namespace);
    $class = str_replace(['\\'], ['/'], $class);
    $class = strtolower($class); // Convert class name to lowercase

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

require BASE_PATH . 'helpers/functions.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = trim(str_replace('/public', '', $uri), ' ');

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
$router = new Router();

require base_path('routes/web.php');
$router->route($uri, $method);

