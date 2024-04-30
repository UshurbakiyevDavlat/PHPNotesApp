<?php

namespace App\Middleware;

class Guest
{
    /**
     * Handle method of Guest middleware
     *
     * @return void
     */
    public function handle(): void
    {
        if ($_SESSION['user'] ?? false) {
            header('Location: /');
            die();
        }
    }
}