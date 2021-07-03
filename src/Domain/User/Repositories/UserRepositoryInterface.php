<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Models\User;

interface UserRepositoryInterface {

    /**
     * @return User[]
     */
    public function findAll(): array;
}
