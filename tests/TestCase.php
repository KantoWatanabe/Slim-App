<?php

namespace Tests;

use DI\ContainerBuilder;
use DI\Container;
use PHPUnit\Framework\TestCase as PHPUnit_TestCase;

class TestCase extends PHPUnit_TestCase
{
    /**
     * @return Container
     */
    protected function getContainer(): Container
    {
        $builder = new ContainerBuilder();

        $builder->addDefinitions(require __DIR__ . '/../config/settings.php');
        $builder->addDefinitions(require __DIR__ . '/../config/dependencies.php');
        
        $container = $builder->build();

        return $container;
    }
}
