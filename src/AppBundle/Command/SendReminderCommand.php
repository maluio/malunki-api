<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendReminderCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('malunki:send-reminder')
            ->setDescription('Sends reminder for due cards')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('Sends reminder for due cards');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $qb = $em->createQueryBuilder();
        $qb->select('m')
            ->from('AppBundle:Card', 'm')
            ->where('m.reviewDate < :now')
            ->setParameter('now', new \DateTime('now'), \Doctrine\DBAL\Types\Type::DATETIME);
        $dueCards = $qb->getQuery()->getResult();

        if (count($dueCards) > 0) {
            $this->sendMail(count($dueCards));
        }
    }

    protected function sendMail($numberOfDueCards) {
        $from = new \SendGrid\Email(null, "malunki@example.com");
        $subject = 'Malunki due cards: ' . $numberOfDueCards;
        $to = new \SendGrid\Email(null, getenv('MAIL_RECIPIENT'));
        $content = new \SendGrid\Content("text/plain", "https://limitless-atoll-18387.herokuapp.com");
        $mail = new \SendGrid\Mail($from, $subject, $to, $content);

        $apiKey = getenv('SENDGRID_API_KEY');
        $sg = new \SendGrid($apiKey);
        $sg->client->mail()->send()->post($mail);
    }
}