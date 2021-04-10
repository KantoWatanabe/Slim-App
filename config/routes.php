<?php
use Slim\App;
use App\Actions\HomeAction;

return function (App $app) {

    $app->get('/', HomeAction::class);
};