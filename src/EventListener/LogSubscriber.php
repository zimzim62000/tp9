<?php

namespace App\EventListener;

use App\AppEvent;
use App\Entity\LogAction;
use App\Entity\UserCard;
use App\Event\UserCardEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class LogSubscriber implements EventSubscriberInterface
{

    private $em;
    private $logAction;

    public function __construct(EntityManagerInterface $entityManager, LogAction $logAction)
    {
        $this->em = $entityManager;
        $this->logAction = $logAction;
    }

    public static function getSubscribedEvents()
    {
        return [
            AppEvent::USER_CARD_ADD => array('add', 0),
            AppEvent::USER_CARD_EDIT => array('update', 0),
            AppEvent::USER_CARD_DELETE => array('remove', 0),
        ];
    }


    public function add(UserCardEvent $userCardEvent)
    {
        $this->persist($userCardEvent, 'ADD');
    }

    public function update(UserCardEvent $userCardEvent)
    {
        $this->persist($userCardEvent, 'UPDATE');
    }

    public function remove(UserCardEvent $userCardEvent)
    {
        $this->persist($userCardEvent, 'DELETE');
    }

    public function persist(UserCardEvent $userCardEvent, $type)
    {
        $date = new \DateTime('now');
        $this->logAction->setLog($date->format('d/m/Y h:i:s'). ' : ' . $type.' card '.$userCardEvent->getUserCard()->getCard()->getName().'
        to user ' .$userCardEvent->getUserCard()->getUser()->getEmail());
        $this->em->persist($this->logAction);
        $this->em->flush();
    }
}