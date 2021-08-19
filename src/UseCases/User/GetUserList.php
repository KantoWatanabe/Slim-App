<?php

namespace App\UseCases\User;

use Psr\Container\ContainerInterface;
use Monolog\Logger;
use App\Domain\User\UserRepositoryInterface;

class GetUserList
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
    public function __invoke(): array
    {
        $users = $this->userRepository->findAll();
        $this->logger->debug('users', $users);
        return $users;
    }
}
