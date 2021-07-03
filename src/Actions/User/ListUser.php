<?php

namespace App\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use App\Actions\Action;
use App\Domain\User\Services\UserService;

class ListUser extends Action
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @param ContainerInterface $container
     * @param UserService $userService
     */
    public function __construct(ContainerInterface $container, UserService $userService)
    {
        $this->userService = $userService;
        parent::__construct($container);
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $users = $this->userService->findUsers();
        return $this->json($users);
    }
}
