<?php
/**
 * Created by PhpStorm.
 * User: jeremyclerot
 * Date: 18/12/2017
 * Time: 15:53
 */

namespace App\EventListener;

use App\AppEvent;
use App\Entity\UserCard;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Tests\Fixtures\Entity;
use Symfony\Component\Validator\Constraints\DateTime;

class NoteSkinSubscriber implements EventSubscriberInterface
{
    protected $em;

    public function __construct(EntityManager $em)
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
        $noteskin->setUpdatedAt(new DateTime('now'));
        $this->em->persist($noteskin);
        $this->em->flush();
    }

    public function remove(NoteSkinEvent $noteSkinEvent)
    {
        $this->em->remove($noteSkinEvent->getNoteSkin());
        $this->em->flush();
    }
}