<?php

namespace Tests\UseCases\User;

use Tests\TestCase;
use App\Domain\User\User;
use App\UseCases\User\UserListUseCase;
use App\Infrastructure\User\UserRepository;

class UserListUseCaseTest extends TestCase
{
    public function testList()
    {
        $users = [new User(1, 'testuser1', 'password')];
        $useCase = new UserListUseCase($this->getContainer(), new UserRepository($users));

        $this->assertEquals($users, $useCase->list());
    }
}
