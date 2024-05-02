<?php

declare(strict_types=1);

namespace App\Http\Forms;

use App\Core\Validator;

class RegisterForm
{
    protected array $errors = [];

    /**
     * Register validate method
     *
     * @param string $email
     * @param string $password
     * @return void
     */
    public function validate(string $email, string $password): void
    {
        $emailValidator = Validator::email($email);
        $passwordValidator = Validator::string($password, 7);

        if (!$emailValidator) {
            //validate email
            $this->errors['email'] = 'Please provide valid email';
        }

        if (!empty($passwordValidator)) {
            //validate password
            $this->errors['password'] = 'Password should be min 7 and max 255 characters';
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
}