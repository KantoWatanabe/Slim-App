<?php
namespace App\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use App\Commands\Command;

class ExampleCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'console:example';
 
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setDescription('This command is example')
            ->setHelp('This command is example')
            ->addArgument('name', InputArgument::OPTIONAL, 'The username of the user.', 'World')
            ->addOption('env', 'e', InputOption::VALUE_OPTIONAL, 'The environment of the command.', $this->get('settings')['environment']);
    }

    /**
     * {@inheritdoc}
     */
    protected function handle(): int
    {
        $this->output->writeln('Hello '.$this->arg('name'));
        $this->output->writeln('The environment is '.$this->opt('env'));

        return $this->success();
    }
}
