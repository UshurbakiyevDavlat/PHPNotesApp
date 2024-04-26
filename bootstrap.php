<?php

use Config\Config;
use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind(Database::class, function () {
    $config = Config::getConfig();
    $fetchOptions = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // fetch option
    ];

    return new Database($config['database'], $fetchOptions);
});

App::setContainer($container);