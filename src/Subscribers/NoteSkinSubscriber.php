<?php


use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NoteSkinSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::NOTE_ADD => 'noteAdd',
            AppEvent::NOTE_EDIT => 'noteEdit',
            AppEvent::NOTE_DELETE=> 'noteDelete'
        );
    }

    public function noteAdd(NoteSkinEvent $noteEvent){

    }
    public function noteEdit(NoteSkinEvent $noteEvent){

    }

    public function noteDelete(NoteSkinEvent $noteEvent){

    }

}