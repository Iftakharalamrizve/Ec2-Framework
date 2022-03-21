<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class CreateCommand extends Command
{
    protected function configure()
    {
        $this->setName('make:command')
            ->addArgument('name', InputArgument::REQUIRED, 'Enter Your Command Name .');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln(sprintf('Hello World!, %s', $input->getArgument('name')));
        return 1 ;
    }
}