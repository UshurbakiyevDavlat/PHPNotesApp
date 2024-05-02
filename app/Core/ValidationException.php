<?php

declare(strict_types=1);

namespace App\Core;

use Exception;

class ValidationException extends Exception
{
    public readonly array $errors;
    public readonly array $old;

    /**
     * Init params for exception instance
     *
     * @param array $errors
     * @param array $old
     * @return static
     * @throws ValidationException
     */
    public static function throw(array $errors, array $old): static
    {
        $instance = new static;

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}