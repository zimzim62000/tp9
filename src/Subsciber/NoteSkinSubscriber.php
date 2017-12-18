<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 18/12/17
 * Time: 17:14
 */

namespace App\Subscriber;


use App\AppEvent;
use App\Entity\NoteSkin;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NoteSkinSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::NOTE_SKIN_ADD => 'noteAdd',
            AppEvent::NOTE_SKIN_EDIT => 'noteEdit',
            AppEvent::NOTE_SKIN_DELETE => 'noteDelete'
        );
    }

    public function noteAdd(NoteSkinEvent $noteSkinEvent)
    {
        $note = $noteSkinEvent->getNoteSkin();
        $note->setCreatedAt(new \DateTime());
        $this->em->persist($note);
        $this->em->flush();
    }

    public function noteEdit(NoteSkinEvent $noteSkinEvent)
    {
        $note = $noteSkinEvent->getNoteSkin();
        $this->em->remove($note);
        $this->em->flush();
    }
}