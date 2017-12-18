<?php

namespace App\EventListener;

use App\AppEvent;
use App\Event\NoteEvent;
use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Event\UserCardEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class NoteSubscriber implements EventSubscriberInterface
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

    public function add(NoteEvent $noteEvent)
    {
        $this->persist($noteEvent);
    }

    public function persist(NoteEvent $noteEvent)
    {
        $this->em->persist($noteEvent->getNote());
        $this->em->flush();
    }

    public function remove(UserCardEvent $userCardEvent)
    {
        $this->em->remove($userCardEvent->getUserCard());
        $this->em->flush();
    }
}