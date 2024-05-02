<?php

declare(strict_types=1);

namespace App\Core;

use Exception;

class Container
{
    private array $bindings = [];

    /**
     * Bind container method
     *
     * @param string $key
     * @param callable $resolver
     * @return void
     */
    public function bind(string $key, callable $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    /**
     * Resolve container method
     *
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public function resolve(string $key): mixed
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception('No key to resolve');
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}