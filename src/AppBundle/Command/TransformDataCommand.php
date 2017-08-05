<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TransformDataCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('malunki:transform-data')
            ->setDescription('Transforms data')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Transforms data');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        /* @var $repo \AppBundle\Repository\CardRepository */
        $repo = $em->getRepository('AppBundle\Entity\Card');
        $cards = $repo->findAll();
        foreach ($cards as $card) {
            $card = $this->transformWord($card);
            $card = $this->transformGender($card);
            $em->persist($card);
        }
        $em->flush();
    }

    protected function transformWord($card){
        preg_match_all(
            '/::.+::/',
            $card->getFront(),
            $hits
        );
        isset($hits[0][0]) ? $word = $hits[0][0] : $word = false;
        if ($word){
            $word = str_replace(
                '::',
                '',
                $word
            );
        }
        $card->setWord($word);
        return $card;

    }

    protected function transformGender($card){
        if (strpos($card->getFront(), ' ;f;') !== FALSE) {
            $card->setGender('female');

            $card->setFront(
                str_replace(
                    ' ;f;',
                    '',
                    $card->getFront()
                )
            );
        }
        if (strpos($card->getFront(), ' ;m;') !== FALSE) {
            $card->setGender('male');

            $card->setFront(
                str_replace(
                    ' ;m;',
                    '',
                    $card->getFront()
                )
            );
        }
        return $card;
    }


}
