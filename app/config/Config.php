<?php

namespace App\config;

class Config
{
    /**
     * Get config method
     *
     * @return array[]
     */
    public static function getConfig(): array
    {
        return [
            'database' => [
                'host' => env('DB_HOST', 'localhost'),
                'port' => env('DB_PORT', '3306'),
                'dbname' => env('DB_NAME', 'native'),
                'user' => env('DB_USER', 'root'),
                'password' => env('DB_PASSWORD', 'root'),
                'charset' => 'utf8mb4',
            ],
        ];
    }
}
