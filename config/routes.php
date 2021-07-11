<?php
use Slim\App;

use App\Middleware\ExampleMiddleware;
use App\Actions\HomeAction;
use App\Actions\User\UserListAction;

return function (App $app) {
    $app->get('/', HomeAction::class)->add(ExampleMiddleware::class);
    $app->get('/users', UserListAction::class)->add(ExampleMiddleware::class);
};
