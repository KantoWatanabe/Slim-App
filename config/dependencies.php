<?php
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;

return [
    'view' => function () {
        $loader = new FilesystemLoader(__DIR__ . '/../templates');
        return new Twig($loader, [
            'cache' => __DIR__ . '/../tmp/cache/twig',
        ]);
    },
];