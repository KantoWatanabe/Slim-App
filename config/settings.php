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
        'database' => [
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
if ($environment && file_exists(__DIR__ . '/env.' . $environment . '.php')) {
    require __DIR__ . '/env.' . $environment . '.php';
}

// CLIの場合はロガー名をコマンド名に置き換え
if (php_sapi_name() === 'cli') {
    $name = isset($argv[1]) ? str_replace(':', '-', $argv[1]) : 'cli';
    $settings['settings']['logger']['name'] = $name;
    $settings['settings']['logger']['path'] = __DIR__ . '/../tmp/logs/' . $name . '.log';
}

return $settings;