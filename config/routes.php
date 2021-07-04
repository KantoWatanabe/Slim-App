<?php
use Slim\App;

use App\Middleware\ExampleMiddleware;
use App\Actions\HomeAction;
use App\Actions\User\ListUser;

return function (App $app) {
    $app->get('/', HomeAction::class)->add(ExampleMiddleware::class);
    $app->get('/users', ListUser::class)->add(ExampleMiddleware::class);
};
