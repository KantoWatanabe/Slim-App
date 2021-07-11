<?php

namespace App\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use App\Actions\Action;
use App\UseCases\User\UserListUseCase;

class UserListAction extends Action
{
    /**
     * @var UserListUseCase
     */
    private UserListUseCase $userListUseCase;

    /**
     * @param ContainerInterface $container
     * @param UserService $userService
     */
    public function __construct(ContainerInterface $container, UserListUseCase $userListUseCase)
    {
        $this->userListUseCase = $userListUseCase;
        parent::__construct($container);
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $users = $this->userListUseCase->list();
        return $this->json($users);
    }
}
