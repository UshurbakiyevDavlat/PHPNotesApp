<?php

namespace App\Core;

use Exception;

class App
{
    protected static Container $container;

    /**
     * Set app container
     *
     * @param Container $container
     * @return void
     */
    public static function setContainer(Container $container): void
    {
        static::$container = $container;
    }

    /**
     * Get app container instance
     *
     * @return mixed
     */
    public static function container(): Container
    {
        return static::$container;
    }

    /**
     * Bind delegation of container
     *
     * @param string $key
     * @param callable $resolver
     * @return void
     */
    public static function bind(string $key, callable $resolver): void
    {
        static::container()->bind($key, $resolver);
    }

    /**
     * Resolve delegation of container
     *
     * @param string $key
     *
     * @return mixed
     * @throws Exception
     */
    public static function resolve(string $key): mixed
    {
        return static::container()->resolve($key);
    }
}