<?php

namespace App\Subscriber;

use App\AppEvent;
use App\Event\UserCardEvent;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Constraints\DateTime;
class UserCardSubscriber implements EventSubscriberInterface
{
    protected $em;
    function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;

    }

    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::USERCARD_ADD => 'usercardAdd',
            AppEvent::USERCARD_EDIT => 'usercardEdit'
        );
    }

    public function userCardAdd(UserCardEvent $userCardEvent){


        $usercard=  $userCardEvent->getUserCard();

        $this->em->persist($usercard);

        $this->em->flush();
        echo 'UserCard bien ajouté';
    }

    public function userCardEdit(UserCardEvent $userCardEvent){

        $usercard=  $userCardEvent->getUserCard();

        $this->em->persist($usercard);

        $this->em->flush();
        echo 'UserCard bien modifié';
    }



}