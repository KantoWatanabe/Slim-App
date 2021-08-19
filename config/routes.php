<?php
use Slim\App;

use App\Middleware\ExampleMiddleware;
use App\Actions\HomeAction;
use App\Actions\User\GetUserListAction;

return function (App $app) {
    $app->get('/', HomeAction::class)->add(ExampleMiddleware::class);
    $app->get('/users', GetUserListAction::class)->add(ExampleMiddleware::class);
};
