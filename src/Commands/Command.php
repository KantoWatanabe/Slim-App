<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\LockableTrait;
use Psr\Container\ContainerInterface;
use Monolog\Logger;

abstract class Command extends BaseCommand
{
    use LockableTrait;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = $this->get('logger');

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;

        if (!$this->lock()) {
            $this->output->writeln('The command is already running in another process.');

            return $this->failure();
        }

        return $this->handle();
    }

    /**
     * @return int
     */
    abstract protected function handle(): int;

    /**
     * @param string $name
     * @return mixed
     */
    protected function get(string $name)
    {
        return $this->container->get($name);
    }

    /**
     * @param string $name
     * @return mixed
     */
    protected function arg(string $name)
    {
        return $this->input->getArgument($name);
    }

    /**
     * @param string $name
     * @return mixed
     */
    protected function opt(string $name)
    {
        return $this->input->getOption($name);
    }

    /**
     * @return int
     */
    protected function success(): int
    {
        return BaseCommand::SUCCESS;
    }

    /**
     * @return int
     */
    protected function failure(): int
    {
        return BaseCommand::FAILURE;
    }
}
