<?php

use App\config\Config;
use App\Core\App;
use App\Core\Container;
use App\Core\Database;

$container = new Container();

$container->bind(Database::class, function () {
    $config = Config::getConfig();
    $user = $config['database']['user'];
    $pass = $config['database']['password'];

    unset($config['database']['user'], $config['database']['password']);

    $fetchOptions = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // fetch option
    ];

    return new Database($config['database'], $user, $pass, $fetchOptions);
});

App::setContainer($container);