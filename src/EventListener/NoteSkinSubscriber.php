<?php

namespace App\EventListener;

use App\AppEvent;

use App\Event\NoteSkinEvent;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class NoteSkinSubscriber implements EventSubscriberInterface
{

    private $em;
    private $session;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->em = $entityManager;
        $this->session = $session;
    }

    public static function getSubscribedEvents()
    {
        return [
            AppEvent::NOTE_ADD => array('add', 0),
        ];
    }


    public function add(NoteSkinEvent $noteSkinEvent)
    {

            $this->persist($noteSkinEvent);
    }

    public function persist(NoteSkinEvent $noteSkinEvent)
    {
        $this->em->persist($noteSkinEvent->getNoteSkin());
        $this->em->flush();
    }

    public function remove(NoteSkinEvent $noteSkinEvent)
    {
        $this->em->remove($noteSkinEvent->getNoteSkin());
        $this->em->flush();
    }
}