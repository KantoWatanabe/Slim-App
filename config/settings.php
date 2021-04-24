<?php
use Monolog\Logger;

error_reporting(0);
ini_set('display_errors', '0');

date_default_timezone_set('Asia/Tokyo');

$settings = [
    'settings' => [
        'environment' => 'default',
        'debug' => false,
        'view' => [
            'path' => __DIR__ . '/../templates',
            'cache' => __DIR__ . '/../tmp/cache/twig',
        ],
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../tmp/logs/app.log',
            'level' => Logger::DEBUG,
        ],
        'db' => [
            'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=example;charset=utf8',
            'username' => 'example',
            'passwd' => 'example',
            'options' => [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ],
        ],
    ]
];

if (file_exists(__DIR__ . '/env.php')) {
    require __DIR__ . '/env.php';
}

$environment = $_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? '';
if ($environment) {
    require __DIR__ . '/env.' . $environment . '.php';
}

return $settings;
