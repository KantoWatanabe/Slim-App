<?php
use Psr\Container\ContainerInterface;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;

use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\User\UserRepository;

return [
    'view' => function (ContainerInterface $container) {
        $settings = $container->get('settings');

        $viewSettings = $settings['view'];
        $loader = new FilesystemLoader($viewSettings['path']);

        return new Twig($loader, [
            'cache' => $viewSettings['cache'],
        ]);
    },
    'logger' => function (ContainerInterface $container) {
        $settings = $container->get('settings');

        $loggerSettings = $settings['logger'];
        $logger = new Logger($loggerSettings['name']);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new RotatingFileHandler($loggerSettings['path'], $loggerSettings['level']);
        $logger->pushHandler($handler);

        return $logger;
    },
    'db' => function (ContainerInterface $container) {
        $settings = $container->get('settings');

        $dbSettings = $settings['db'];
        $dsn = $dbSettings['dsn'];
        $username = $dbSettings['username'];
        $passwd = $dbSettings['passwd'];
        $options = $dbSettings['options'];

        $pdo = new PDO($dsn, $username, $passwd, $options);

        return $pdo;
    },

    UserRepositoryInterface::class => function (ContainerInterface $container) {
        return $container->get(UserRepository::class);
    }
];
