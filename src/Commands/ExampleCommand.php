<?php

namespace App\Commands;

use Symfony\Component\Console\Input\InputArgument;
use App\Commands\Command;

class ExampleCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $command = 'console:example';

    /**
     * {@inheritdoc}
     */
    protected $description = 'This command is example';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();
        $this->addArgument('name', InputArgument::OPTIONAL, 'The username of the user.', 'World');
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
