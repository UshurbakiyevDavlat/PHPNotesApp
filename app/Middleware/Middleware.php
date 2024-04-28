<?php

declare(strict_types=1);

class Middleware
{
    public static array $MAP = [
        'auth' => Auth::class,
        'guest' => Guest::class,
    ];

    /**
     * Resolve mapping for middlewares
     *
     * @throws Exception
     */
    public static function resolve($key): void
    {
        $middleware = static::$MAP[$key] ?? false;

        if (!$middleware) {
            throw new Exception(sprintf('No appropriate middleware according to %s key', $key));
        }

        (new $middleware)->handle();
    }
}