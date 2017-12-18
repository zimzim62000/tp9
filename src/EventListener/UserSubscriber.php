<?php
/**
 * Created by PhpStorm.
 * User: alexis.delarre
 * Date: 13/12/17
 * Time: 09:21
 */

namespace App\EventListener;


use App\AppEvent;
use App\Event\UserEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserSubscriber implements EventSubscriberInterface
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
            AppEvent::USER_ADD => array('add', 0)

        ];
    }

    public function add(UserEvent $userevent)
    {
        $user = $userevent->getUser();
        $this->em->persist($user);
        $this->em->flush();
    }
}