<?php

namespace App\Middleware;

class Auth
{
    /**
     * TODO need to make interface for all middlewares contraction
     * Handle method of Auth middleware
     *
     * @return void
     */
    public function handle(): void
    {
        if (!($_SESSION['user'] ?? false)) {
           redirect('/');
        }
    }
}