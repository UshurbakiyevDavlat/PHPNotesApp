<?php
namespace Config;

class Config
{
    public static function getConfig(): array
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
