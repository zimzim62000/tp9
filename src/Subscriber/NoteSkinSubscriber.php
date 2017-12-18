<?php

namespace App\Subscriber;

use App\AppEvent;

use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Tests\Fixtures\Entity;
use Symfony\Component\Validator\Constraints\DateTime;

class NoteSkinSubscriber implements EventSubscriberInterface
{
    protected $em;

    /**
     * NoteSkinSubscriber constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public static function getSubscribedEvents()
    {
        return array(AppEvent::NOTE_SKIN_ADD => 'noteskinAdd',
                     AppEvent::NOTE_SKIN_EDIT => 'noteskinEdit',
                     AppEvent::NOTE_SKIN_DELETE => 'noteskinDelete',
        );
    }
    public function noteskinAdd(NoteSkinEvent $noteSkinEvent){
        $noteskin = $noteSkinEvent->getNoteskin();
        $this->em->persist($noteskin);
        $this->em->flush();
    }

    public function noteskinEdit(NoteSkinEvent $noteSkinEvent)
    {
        $noteskin = $noteSkinEvent->getNoteskin();
        $this->em->persist($noteskin);
        $this->em->flush();
    }
    public function noteskinDelete(NoteSkinEvent $noteSkinEvent)
    {
        $noteskin = $noteSkinEvent->getNoteskin();
        $this->em->remove($noteskin);
        $this->em->flush();
    }

}