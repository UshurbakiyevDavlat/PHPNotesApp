<?php

const BASE_PATH = __DIR__ . '/../';

spl_autoload_register(static function ($class) {
    $class = str_replace('\\', '/', $class); // Replace backslashes with forward slashes
    $class = strtolower($class); // Convert class name to lowercase

    // Define the base directory where your classes are located

    // Define the directories to search for classes
    $directories = [
        'helpers',
        'routes',
        'config',
        'database',
        'enums'
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
require base_path('routes/web.php');