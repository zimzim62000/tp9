<?php
/**
 * Created by PhpStorm.
 * User: emanuelevella
 * Date: 11/12/2017
 * Time: 15:11
 */

namespace App\Subscriber;
use App\Event\AppEvent;
use App\Entity\UserCard;
use App\Event\UserCardEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserCardSubscriber implements EventSubscriberInterface
{
    private $entityManager;
    /**
     * UserCardSubscriber constructor.
     * @param $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return array(AppEvent::USERCARD_ADD => 'userCardAdd',
            AppEvent::USERCARD_EDIT => 'usercardEdit',
            AppEvent::USERCARD_DELETE => 'userCardDelete'
            );
    }

    public function userCardAdd(UserCard $userCardEvent){
        $this->entityManager->persist($userCardEvent->getCard());
        $this->entityManager->flush();
    }
}