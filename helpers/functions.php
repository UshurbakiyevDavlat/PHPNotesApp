<?php

use App\Response\Response;
use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd($value): void
{
    var_dump($value);
    die();
}

function urlIs($uri): bool
{
    return $uri === $_SERVER['REQUEST_URI'];
}

function authorize($condition, $statusCode = Response::FORBIDDEN): void
{
    if ($condition) {
        abort($statusCode);
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
