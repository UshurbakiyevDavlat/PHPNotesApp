<?php

declare(strict_types=1);

namespace App\Services;

use Core\App;
use Core\Database;
use Exception;

class AuthService
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
     * Get user that currently authenticated
     *
     * @return array|bool
     */
    public function getAuthenticatedUser(): array|bool
    {
        $email = $_SESSION['user']['email'];
        return $this->db->query('SELECT * FROM users where email = :email', ['email' => $email])->first();
    }
}