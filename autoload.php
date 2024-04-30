<?php

spl_autoload_register(static function ($class) {
    $namespace = explode('\\', $class);
    $class = strtolower(str_replace(['\\'], ['/'], array_pop($namespace)));

    // TODO here you need to consider what to do with nest folders, it can't be like that
    $directories = [
        'Http/Controllers',
        'Http/Controllers/register',
        'Http/Controllers/session',
        'Http/Forms',
        'app/Middleware',
        'app/Enums',
        'app/Services',
        'Core',
        'routes',
        'config',
    ];

    foreach ($directories as $directory) {
        $path = BASE_PATH . $directory . '/' . $class . '.php';
        if (file_exists($path)) {
            require $path;
            break;
        }
    }
});