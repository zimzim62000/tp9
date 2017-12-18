<?php

namespace App\Subscriber;

use App\AppEvent;

use App\Event\NoteSkinEvent;
use App\Event\SkinEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Tests\Fixtures\Entity;
use Symfony\Component\Validator\Constraints\DateTime;

class SkinSubscriber implements EventSubscriberInterface
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
        return array(AppEvent::SKIN_ADD => 'noteskinAdd',
            AppEvent::SKIN_EDIT => 'noteskinEdit',
        );
    }
    public function noteskinAdd(SkinEvent $skinEvent){
        $skin = $skinEvent->getSkin();
        $this->em->persist($skin);
        $this->em->flush();
    }

    public function noteskinEdit(SkinEvent $skinEvent)
    {
        $skin = $skinEvent->getSkin();
        $this->em->persist($skin);
        $this->em->flush();
    }

}