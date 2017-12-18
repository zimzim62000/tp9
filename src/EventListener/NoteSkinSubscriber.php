<?php
/**
 * Created by PhpStorm.
 * User: jeremyclerot
 * Date: 18/12/2017
 * Time: 15:53
 */
namespace App\EventListener;

use App\AppEvent;
use App\Entity\NoteSkin;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class NoteSkinSubscriber implements EventSubscriberInterface
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
            AppEvent::NOTE_SKIN_ADD => array('add', 0),
            AppEvent::NOTE_SKIN_EDIT => array('persist', 0),
            AppEvent::NOTE_SKIN_DELETE => array('remove', 0),
        ];
    }

    public function add(NoteSkinEvent $noteSkinEvent)
    {
        $entities = $this->em->getRepository(NoteSkin::class)->findBy(
            ['user' => $noteSkinEvent->getNoteSkin()->getUser()]
        );
        $this->persist($noteSkinEvent);
    }

    public function persist(UserCardEvent $userCardEvent)
    {
        $this->em->persist($userCardEvent->getUserCard());
        $this->em->flush();
    }

    public function remove(UserCardEvent $userCardEvent)
    {
        $this->em->remove($userCardEvent->getUserCard());
        $this->em->flush();
    }


}