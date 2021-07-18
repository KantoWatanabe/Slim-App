<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$settings['environment'] = 'testing';
$settings['debug'] = true;

$settings['logger']['name'] = 'testing';
$settings['logger']['path'] = __DIR__ . '/../tmp/logs/testing.log';
