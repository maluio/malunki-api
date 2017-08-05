<?php

namespace AppBundle\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use AppBundle\Entity\Card;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/*
 * I only keep this class as reference for a Eventsubscriber... @todo: could be removed
 */

final class CardDeserializeSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [['calculateEFactor', EventPriorities::PRE_WRITE]],
        ];
    }

    public function calculateEFactor(GetResponseForControllerResultEvent $event)
    {
        $card = $event->getControllerResult();
        if ($card instanceof Card){
         //   $calculator = $this->get('app.calculator');
        //    dump($calculator->test());
        //    $card->setEFactor(1111);
         //   $event->setControllerResult($card);
        }
    }
}
