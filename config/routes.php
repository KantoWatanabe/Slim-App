<?php
use Slim\App;

use App\Middleware\ExampleMiddleware;
use App\Actions\HomeAction;

return function (App $app) {

    $app->get('/', HomeAction::class)->add(ExampleMiddleware::class);
};
