<?php
namespace ESGI\BlogBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('esgi:stats')
            ->setDescription('Display blog stats')
            ->addArgument('filter', InputArgument::OPTIONAL, 'Qui voulez vous saluer??')
            //->addOption('yell', null, InputOption::VALUE_NONE, 'Si définie, la tâche criera en majuscules')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em =  $this->getContainer()->get('doctrine');
        $name = $input->getArgument('filter');
        $count = $em->getRepository('ESGIBlogBundle:Post')->count($name);
        $output->writeln($count);
    }
}
