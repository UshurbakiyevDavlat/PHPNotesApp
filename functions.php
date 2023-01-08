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