<?php
namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\LockableTrait;
use Psr\Container\ContainerInterface;
use Twig\Environment as Twig;
use Monolog\Logger;
use PDO;

class ExampleCommand extends Command
{
    use LockableTrait;

    protected static $defaultName = 'console:example';

    private ContainerInterface $container;
    private Twig $view;
    private Logger $logger;
    private PDO $db;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $this->container->get('view');
        $this->logger = $this->container->get('logger');
        $this->db = $this->container->get('database');

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('This command is example')
            ->setHelp('This command is example')
            ->addArgument('username', InputArgument::OPTIONAL, 'The username of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return Command::FAILURE;
        }

        $output->writeln('Hellow '.$input->getArgument('username'));

        return Command::SUCCESS;
    }
}