<?php

namespace App;

use App\AppAccess;
use App\UserEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserCardSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    private $manager;

    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    public static function getSubscribedEvents()
    {
        return array(
            AppAccess::UserCardAdd => 'userCardAdd'
        );
    }

    public function userCardAdd(UserCardEvent $userCardEvent){
        $userCard = $userCardEvent->getUserCard();

        $this->manager->persist($userCard);
        $this->manager->flush();

        //var_dump($userCard->getName());
    }


}