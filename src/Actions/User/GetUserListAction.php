<?php

namespace App\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use App\Actions\Action;
use App\UseCases\User\GetUserList;

class GetUserListAction extends Action
{
    /**
     * @var UserListUseCase
     */
    private GetUserList $getUserList;

    /**
     * @param ContainerInterface $container
     * @param UserService $userService
     */
    public function __construct(ContainerInterface $container, GetUserList $getUserList)
    {
        parent::__construct($container);
        $this->getUserList = $getUserList;
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $users = ($this->getUserList)();
        return $this->json($users);
    }
}
