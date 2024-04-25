<?php
namespace Config;

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
                'host' => 'localhost',
                'port' => '3306',
                'dbname' => 'native',
                'charset' => 'utf8mb4'
            ],
        ];
    }
}
