<?php

function dd($value)
{
    var_dump($value);
    die();
}

function url_is($uri)
{
    return $uri === $_SERVER['REQUEST_URI'];
}