<?php

spl_autoload_register(static function ($class) {
    $namespace = explode('\\', $class);
    $class = strtolower(str_replace(['\\'], ['/'], array_pop($namespace)));

    // Define the directories to search for classes
    // TODO here you need to consider what to do with nest folders, it can't be like that
    $directories = [
        'app/controllers',
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