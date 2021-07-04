<?php

namespace App\Commands;

use Symfony\Component\Console\Input\InputArgument;
use App\Commands\Command;

class ExampleCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('console:example')
            ->setDescription('This command is example')
            ->addArgument('name', InputArgument::OPTIONAL, 'The username of the user.', 'World');
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
