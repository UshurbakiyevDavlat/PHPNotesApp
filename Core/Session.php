<?php

declare(strict_types=1);

namespace Core;

class Session
{
    /**
     * Put value to session
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function put(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get value from session, check if key existing within flash and return it then
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? null;
    }

    /**
     * Flash value to session
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function flash(string $key, mixed $value): void
    {
        $_SESSION['_flash'][$key] = $value;
    }

    /**
     * Unflash session
     *
     * @return void
     */
    public static function unflash(): void
    {
        unset($_SESSION['_flash']);
    }

    /**
     * Flush session
     *
     * @return void
     */
    public static function flush(): void
    {
        $_SESSION = [];
    }

    /**
     * Destroy session
     *
     * @return void
     */
    public static function destroy(): void
    {
        self::flush();

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
}