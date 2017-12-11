<?php

namespace App\Subscriber;

use App\Event\AppEvent;
use App\Event\UserCardEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserCardSubscriber implements EventSubscriberInterface
{
    private $manager;


    /**
     * PlayerSubscriber constructor.
     */
    public function __construct(\Doctrine\ORM\EntityManagerInterface $manager)
    {
        $this->manager=$manager;
    }

    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::USERCARD_ADD => 'usercardAdd'
        );
    }

    public function usercardAdd(UserCardEvent $userCardEvent){

        $userCard= $userCardEvent->getUsercard();
        $this->manager->persist($userCard);
        $this->manager->flush();
        echo 'ok ajout userCard';
    }

}