<?php

namespace Tests\Domain\User\Services;

use Tests\TestCase;
use App\Domain\User\Models\User;
use App\Domain\User\Services\UserService;
use App\Infrastructure\User\UserRepository;

class UserServiceTest extends TestCase
{
    public function testFindAll()
    {
        $users = [new User(1, 'testuser1', 'password')];
        $service = new UserService($this->getContainer(), new UserRepository($users));

        $this->assertEquals($users, $service->findUsers());
    }
}
