<?php

declare(strict_types=1);

namespace Core;

use Exception;

class Authenticator
{
    private mixed $db;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    /**
     * Return result of attempting credentials
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function attempt(string $email, string $password): bool
    {
        $user = $this->db->query('SELECT * FROM users where email=:email', ['email' => $email])->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                login($email);
                return true;
            }
        }

        return false;
    }
}