<?php

declare(strict_types=1);

namespace App\Core;

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
                self::login($email);
                return true;
            }
        }

        return false;
    }

    /**
     * Login function
     *
     * @param string $email
     * @return void
     */
    public function login(string $email): void
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
    public function logout(): void
    {
        Session::destroy();
    }
}