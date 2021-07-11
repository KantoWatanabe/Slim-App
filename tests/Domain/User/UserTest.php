<?php

namespace Tests\Domain\User\Models;

use Tests\TestCase;
use App\Domain\User\User;

class UserTest extends TestCase
{
    public function provider()
    {
        return [
            [1, 'testuser1', 'password'],
        ];
    }

    /**
     * @dataProvider provider
     * @param $id
     * @param $username
     * @param $password
     */
    public function testGetters($id, $username, $password)
    {
        $user = new User($id, $username, $password);

        $this->assertEquals($id, $user->getId());
        $this->assertEquals($username, $user->getUsername());
        $this->assertEquals($password, $user->getPassword());
    }

    /**
     * @dataProvider provider
     * @param $id
     * @param $username
     * @param $password
     */
    public function testJsonSerialize($id, $username, $password)
    {
        $user = new User($id, $username, $password);

        $expected = json_encode([
            'id' => $id,
            'username' => $username,
            'password' => $password,
        ]);

        $this->assertEquals($expected, json_encode($user));
    }
}
