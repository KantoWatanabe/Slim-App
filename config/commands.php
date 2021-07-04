<?php
use Symfony\Component\Console\Application;
use Psr\Container\ContainerInterface;

use App\Commands\ExampleCommand;

return function (Application $app, ContainerInterface $container) {
    $app->add($container->get(ExampleCommand::class));
};
