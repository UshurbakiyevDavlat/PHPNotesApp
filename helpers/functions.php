<?php

use Response\Response;

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
        require base_path($routes[$uri]);
    } else {
        abort(404);
    }
}

function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);
    return require view('errors/' . $code);
}

function base_path($path = ''): string
{
    return BASE_PATH . $path;
}

function view($view, $data = [])
{
    extract($data, EXTR_SKIP);
    return require base_path( "resources/views/{$view}.view.php");
}
