<?php

function dd($value)
{
    var_dump($value);
    die();
}

function urlIs($uri)
{
    return $uri === $_SERVER['REQUEST_URI'];
}