<?php

function dd($value)
{
    var_dump($value);
    die();
}

function urlIs($uri): bool
{
    return $uri === $_SERVER['REQUEST_URI'];
}

function authorize($condition, $statusCode = Response::FORBIDDEN)
{
    if ($condition) {
        abort($statusCode);
    }
}

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }

}

function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);

    require 'views/errors/' . $code . 'php';

    die();
}
