<?php
use Psr\Container\ContainerInterface;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;

return [
    'view' => function (ContainerInterface $container) {
        $settings = $container->get('settings');

        $viewSettings = $settings['view'];
        $loader = new FilesystemLoader($viewSettings['path']);

        return new Twig($loader, [
            'cache' => $viewSettings['cache'],
        ]);
    },
];