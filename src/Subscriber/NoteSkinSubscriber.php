<?php

namespace App\Subscriber;

use App\AppEvent;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NoteSkinSubscriber implements EventSubscriberInterface
{
    private $entityManager;

    /**
     * NoteSkinSubscriber constructor.
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return array(AppEvent::NOTESKIN_ADD => 'noteSkinAdd',
            AppEvent::NOTESKIN_EDIT => 'noteSkinEdit',
            AppEvent::NOTESKIN_REMOVE => 'noteSkinRemove');
    }

    public function noteSkinAdd(NoteSkinEvent $noteSkinEvent){
        $this->entityManager->persist($noteSkinEvent->getNoteskin());
        //\mail("admin@admin.fr","Nouvelle note", "Une note a été ajouté");
        $this->entityManager->flush();
    }

    public function noteSkinEdit(NoteSkinEvent $noteSkinEvent){
        $this->entityManager->persist($noteSkinEvent->getNoteskin());
        //\mail($noteSkinEvent->getNoteskin()->getUser()->getEmail(),"note edit", "votre note a été edite par un admin");
        $this->entityManager->flush();
    }

    public function noteSkinRemove(NoteSkinEvent $noteSkinEvent){
        $this->entityManager->remove($noteSkinEvent->getNoteskin());
        //\mail($noteSkinEvent->getNoteskin()->getUser()->getEmail(),"note remove", "votre note a été supprimé par un admin");
        $this->entityManager->flush();
    }
}