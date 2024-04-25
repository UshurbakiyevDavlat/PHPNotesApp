<?php

use App\Response\ResponseEnum;
use JetBrains\PhpStorm\NoReturn;

/**
 * Die and dump function
 *
 * @param $value
 * @return void
 */
#[NoReturn] function dd($value): void
{
    var_dump($value);
    die();
}

/**
 * Check url function
 *
 * @param $uri
 * @return bool
 */
function urlIs($uri): bool
{
    return $uri === $_SERVER['REQUEST_URI'];
}

/**
 * Authorize function
 *
 * @param $condition
 * @param int $statusCode
 * @return void
 */
function authorize($condition, int $statusCode = ResponseEnum::FORBIDDEN): void
{
    if ($condition) {
        abort($statusCode);
    }
}

/**
 * Abort operation function
 *
 * @param int $code
 * @return mixed
 */
function abort(int $code = ResponseEnum::NOT_FOUND): mixed
{
    http_response_code($code);
    return require view('errors/' . $code);
}

/**
 * Generate base path function
 *
 * @param string $path
 * @return string
 */
function base_path(string $path = ''): string
{
    return BASE_PATH . $path;
}

/**
 * View template function
 *
 * @param $view
 * @param array $data
 * @return mixed
 */
function view($view, array $data = []): mixed
{
    extract($data, EXTR_SKIP);
    return require base_path("resources/views/{$view}.view.php");
}

/**
 * Get env variable helper function
 *
 * @param string $variable
 * @param string $default
 * @return bool|array|string
 */
function env(string $variable, string $default): bool|array|string
{
    return getenv($variable) ?? $default;
}
