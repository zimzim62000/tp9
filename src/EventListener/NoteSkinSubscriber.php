<?php
/**
 * Created by PhpStorm.
 * User: emanuelevella
 * Date: 18/12/2017
 * Time: 16:11
 */

namespace App\EventListener;

use App\AppEvent;
use App\Entity\NoteSkin;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class NoteSkinSubscriber implements EventSubscriberInterface
{

    private $em;
    private $token;

    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $token)
    {
        $this->em = $entityManager;
        $this->token = $token;
    }

    public static function getSubscribedEvents()
    {
        return [
            AppEvent::NOTE_SKIN_ADD => array('add', -255),
            AppEvent::NOTE_SKIN_EDIT => array('update', -255),
            AppEvent::NOTE_SKIN_DELETE => array('delete', -255),
        ];
    }

    public function add(NoteSkinEvent $noteSkinEvent)
    {
            $this->persist($noteSkinEvent);
    }

    public function update(NoteSkinEvent $noteSkinEvent)
    {
        $this->persist($noteSkinEvent->getNoteSkin());
    }

    public function remove(NoteSkinEvent $noteSkinEvent)
    {
        $this->em->remove($noteSkinEvent->getNoteSkin());
        $this->em->flush();
    }

    public function persist(NoteSkinEvent $noteSkinEvent)
    {
        $this->em->persist($noteSkinEvent->getNoteSkin());
        $this->em->flush();
    }
}