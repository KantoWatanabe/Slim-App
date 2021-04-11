<?php
use Monolog\Logger;

$settings = [
    'settings' => [
        'view' => [
            'path' => __DIR__ . '/../templates',
            'cache' => __DIR__ . '/../tmp/cache/twig',
        ],
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../tmp/logs/app.log',
            'level' => Logger::DEBUG,
        ]
    ]
];

if (file_exists(__DIR__ . '/env.php')) {
    require __DIR__ . '/env.php';
}

$environment = $_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? '';
if ($environment && file_exists(__DIR__ . '/env.' . $environment . '.php')) {
    require __DIR__ . '/env.' . $environment . '.php';
}

return $settings;