<?php

declare(strict_types=1);

namespace App\Http\Forms;

use App\Core\ValidationException;
use App\Core\Validator;

class LoginForm
{
    protected array $errors = [];

    public function __construct(public $attributes)
    {
        $emailValidator = Validator::email($this->attributes['email']);
        $passwordValidator = Validator::string($this->attributes['password']);

        if (!$emailValidator) {
            $this->errors['email'] = 'Please provide valid email';
        }

        if (!empty($passwordValidator)) {
            $this->errors['password'] = 'Please provide valid password';
        }
    }

    /**
     * Login validate method
     *
     * @param array $attributes
     * @return ValidationException|LoginForm
     * @throws ValidationException
     */
    public static function validate(array $attributes): ValidationException|LoginForm
    {
        $instance = new static($attributes);
        return $instance->failed() ? $instance->throw() : $instance;
    }

    /**
     * Delegate for validation exception class
     *
     * @return ValidationException
     * @throws ValidationException
     */
    public function throw(): ValidationException
    {
        return ValidationException::throw($this->errors(), $this->attributes);
    }

    /**
     * Get errors method
     *
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Check if validation failed or not
     *
     * @return bool
     */
    public function failed(): bool
    {
        return (bool)count($this->errors);
    }

    /**
     * Addition error to errors scope
     *
     * @param string $field
     * @param string $message
     * @return LoginForm
     */
    public function error(string $field, string $message): static
    {
        $this->errors[$field] = $message;

        return $this;
    }
}