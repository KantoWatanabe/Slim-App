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

        $settings = require __DIR__ . '/../config/settings.php';
        
        $name = 'tests';
        $settings['settings']['logger']['name'] = $name;
        $settings['settings']['logger']['path'] = __DIR__ . '/../tmp/logs/' . $name . '.log';
        
        $builder->addDefinitions($settings);
        $builder->addDefinitions(require __DIR__ . '/../config/dependencies.php');
        
        $container = $builder->build();

        return $container;
    }
}
