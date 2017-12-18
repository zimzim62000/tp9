<?php

namespace App\EventListener;

use App\AppEvent;
use App\Entity\NoteSkin;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class NoteSkinSubscriber implements EventSubscriberInterface
{

    private $em;

    private $sto;


    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $storage)
    {
        $this->em = $entityManager;
        $this->sto = $storage;
    }

    public static function getSubscribedEvents()
    {
        return [
            AppEvent::NOTE_ADD => array('add', 0),
            AppEvent::NOTE_EDIT => array('edit', 0),
            AppEvent::NOTE_DELETE => array('remove', 0)
        ];
    }


    public function add(NoteSkinEvent $noteSkinEvent){

        $noteSkin = $noteSkinEvent->getNoteSkin();
        $this->em->persist($noteSkin);
        $this->em->flush();
    }

    public function remove(NoteSkinEvent $noteSkinEvent)
    {
        $this->em->remove($noteSkinEvent->getNoteSkin());
        $this->em->flush();
    }
}