<?php

class Config
{
    public static function env(): array
    {
        return [
            'database' => [
                'host' => 'localhost',
                'port' => '3306',
                'dbname' => 'php_native_framework',
                'charset' => 'utf8mb4'
            ],
        ];
    }
}