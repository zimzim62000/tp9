<?php

namespace App\EventListener;

use App\AppEvent;
use App\Entity\UserCard;
use App\Event\UserCardEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class UserCardSubscriber implements EventSubscriberInterface
{

    private $em;
    private $session;
    private $nbMaxUserCard;

    public function __construct(EntityManagerInterface $entityManager, Session $session, $nbMaxUserCard)
    {
        $this->em = $entityManager;
        $this->session = $session;
        $this->nbMaxUserCard = $nbMaxUserCard;
    }

    public static function getSubscribedEvents()
    {
        return [
            AppEvent::USER_CARD_ADD => array('add', 255),
            AppEvent::USER_CARD_EDIT => array('persist', 255),
            AppEvent::USER_CARD_DELETE => array('remove', 255),
        ];
    }


    public function add(UserCardEvent $userCardEvent)
    {
        $entities = $this->em->getRepository(UserCard::class)->findBy(
            ['user' => $userCardEvent->getUserCard()->getUser()]
        );
        if(count($entities) < $this->nbMaxUserCard){
            $this->persist($userCardEvent);
        } else{
            $this->session->getFlashBag()->add('error', 'max usercard reached !');
            $userCardEvent->stopPropagation();
        }
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