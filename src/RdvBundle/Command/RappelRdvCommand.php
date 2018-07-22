<?php

// src/AppBundle/Command/GreetCommand.php
namespace RdvBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use RdvBundle\Entity\Rdv;

class RappelRdvCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('rdvenligne:rappels')
            ->setDescription('Envoyer des rappels aux clients')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $rdvRepo = $em->getRepository(Rdv::class);

        foreach($rdvRepo->getRdvARapeller() as $rdv)
        {
            $message = (new \Swift_Message('Rappel rdv'))
                ->setFrom($this->getContainer()->getParameter('mailer_user'))
                ->setTo($rdv->getUserId()->getEmail())
                ->setBody(
                    $this->getContainer()->get('twig')->render(
                        'RdvBundle:Email:rappel_client.html.twig', array(
                            'oRdv' => $rdv
                        )
                    ),
                    'text/html'
                );

            $this->getContainer()->get('mailer')->send($message);
            $rdvRepo->rappellerRdv($rdv->getId());
        }
    }
}
