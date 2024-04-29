<?php

use App\Enums\ResponseEnum;
use JetBrains\PhpStorm\NoReturn;

/**
 * Die and dump function
 *
 * @param mixed $value
 * @return void
 */
#[NoReturn] function dd(mixed ...$value): void
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
 * @param bool $condition
 * @param int $statusCode
 * @return void
 */
function authorize(bool $condition, int $statusCode = ResponseEnum::FORBIDDEN): void
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

/**
 * Login function
 *
 * @param string $email
 * @return void
 */
function login(string $email): void
{
    $_SESSION['user'] = [
        'email' => $email,
    ];

    session_regenerate_id();
}

/**
 * Logout function
 *
 * @return void
 */
function logout(): void
{
    $_SESSION['user'] = [];

    $params = session_get_cookie_params();

    setcookie(
        'PHPSESSID',
        '',
        time() - 3600,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly'],
    );
}
