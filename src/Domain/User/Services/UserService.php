<?php

namespace App\Domain\User\Services;

use Psr\Container\ContainerInterface;
use Monolog\Logger;
use App\Domain\User\Repositories\UserRepositoryInterface;

class UserService
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @param ContainerInterface $container
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(ContainerInterface $container, UserRepositoryInterface $userRepository)
    {
        $this->logger = $container->get('logger');
        $this->userRepository = $userRepository;
    }

    /**
     * @return User[]
     */
    public function findUsers(): array
    {
        $users = $this->userRepository->findAll();
        $this->logger->debug('users', $users);
        return $users;
    }
}
