<?php

namespace App\Domain\User\Services;

use App\Domain\User\Repositories\UserRepositoryInterface;

class UserService {

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return User[]
     */
    public function findUsers(): array
    {
        return $this->userRepository->findAll();
    }
}
