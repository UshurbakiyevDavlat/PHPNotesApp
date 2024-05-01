<?php

declare(strict_types=1);

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected array $errors = [];

    /**
     * Login validate method
     *
     * @param string $email
     * @param string $password
     * @return void
     */
    public function validate(string $email, string $password): void
    {
        $emailValidator = Validator::email($email);
        $passwordValidator = Validator::string($password);

        if (!$emailValidator) {
            //validate email
            $this->errors['email'] = 'Please provide valid email';
        }

        if (!empty($passwordValidator)) {
            //validate password
            $this->errors['password'] = 'Please provide valid password';
        }
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
     * Addition error to errors scope
     *
     * @param string $field
     * @param string $message
     * @return void
     */
    public function error(string $field, string $message): void
    {
        $this->errors[$field] = $message;
    }
}