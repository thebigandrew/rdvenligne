<?php

// src/AppBundle/Command/GreetCommand.php
namespace RdvBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class CronLauncherCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('rdvenligne:cronlauncher')
            ->setDescription('Lancer le cron de rappel')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        while( true)
        {
            $process = new Process('php bin/console rdvenligne:rappels');
            $process->run();

            // On dort 1 minute
            sleep(60);
        }
        
    }
}
