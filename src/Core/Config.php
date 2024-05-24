<?php

namespace App\Core;

class Config
{
    private static array $settings = [
        'db' => [
            'host' => 'localhost',
            'name' => 'simple_framework2',
            'user' => 'root',
            'password' => 'TestTest1234!!'
        ],
        'template' => [
            'path' => __DIR__ . '/../../templates',
            'layout' => 'base'
        ],
        'is_debug' => true
    ];

    public static function get(string $key, ?string $default = null): mixed
    {
        return self::$settings[$key] ?? $default;
    }
}