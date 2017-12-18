<?php
/**
 * Created by PhpStorm.
 * User: alexis.delarre
 * Date: 18/12/17
 * Time: 16:47
 */

namespace App\EventListener;



use App\AppEvent;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NoteSkinSubscriber implements EventSubscriberInterface
{
    private $em;

    /**
     * UserSubscriber constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            AppEvent::NOTE_SKIN_ADD => array('add', 0),
            AppEvent::NOTE_SKIN_DELETE =>array("remove",0),
            AppEvent::NOTE_SKIN_EDIT => array ("edit",0)

        ];
    }

    public function add(NoteSkinEvent $noteEvent)
    {
        $user = $noteEvent->getNoteSkin();
        $this->em->persist($user);
        $this->em->flush();
    }

    public function persist(NoteSkinEvent $noteEvent)
    {
        $this->em->persist($user = $noteEvent->getNoteSkin());
        $this->em->flush();
    }

    public function remove(NoteSkinEvent $noteEvent)
    {
        $this->em->remove($user = $noteEvent->getNoteSkin());
        $this->em->flush();
    }
}