<?php

namespace App\Subscriber;

use App\AppEvent;
use App\Entity\UserCard;
use App\Event\UserCardEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Tests\Fixtures\Entity;
use Symfony\Component\Validator\Constraints\DateTime;



class UserCardSubscriber implements EventSubscriberInterface
{
    protected $em;


    /**
     * PlayerSubscriber constructor.
     * @param $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;

    }


    public static function getSubscribedEvents()
    {
        return array(AppEvent::USERCARD_ADD => 'usercardAdd',
            AppEvent::USERCARD_EDIT => 'usercardEdit',
            AppEvent::USERCARD_REMOVE => 'usercardRemove');
    }

    public function usercardAdd(UserCardEvent $usercardEvent){

        $usercard = $usercardEvent->getUsercard();
        $this->em->persist($usercard);
        $this->em->flush();

        echo 'ok ajout usercard';
    }

    public function usercardEdit(UserCardEvent $usercardEvent){

        $usercard = $usercardEvent->getUsercard();


        $this->em->persist($usercard);
        $this->em->flush();

    }

    public function usercardRemove(UserCardEvent $usercardEvent)
    {
        $usercard = $usercardEvent->getUsercard();

        $this->em->remove($usercard);
        $this->em->flush();
    }

}