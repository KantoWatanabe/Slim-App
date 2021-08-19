<?php

namespace Tests\UseCases\User;

use Tests\TestCase;
use App\Domain\User\User;
use App\UseCases\User\GetUserList;
use App\Infrastructure\User\UserRepository;

class GetUserListTest extends TestCase
{
    public function testGetUserList()
    {
        $users = [new User(1, 'testuser1', 'password')];
        $getUserList = new GetUserList($this->getContainer(), new UserRepository($users));

        $this->assertEquals($users, $getUserList());
    }
}
