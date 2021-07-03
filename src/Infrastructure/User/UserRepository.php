<?php

namespace App\Infrastructure\User;

use App\Domain\User\Models\User;
use App\Domain\User\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @var User[]
     */
    private $users;

    /**
     * @param array|null $users
     */
    public function __construct(array $users = null)
    {
        $this->users = $users ?? [
            new User(1, 'username1', 'password1'),
            new User(2, 'username2', 'password2'),
            new User(3, 'username3', 'password3'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return $this->users;
    }
}
