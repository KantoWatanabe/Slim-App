<?php

namespace App\Domain\User;

use App\Domain\User\User;

interface UserRepositoryInterface
{
    /**
     * @return User[]
     */
    public function findAll(): array;
}
