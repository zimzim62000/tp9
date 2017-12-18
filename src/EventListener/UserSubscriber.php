<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 13/12/17
 * Time: 15:17
 */

namespace App\EventListener;


use App\AppEvent;
use App\Entity\User;
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

    public function add(UserEvent $userEvent){
        $entiti=$this->em->getRepository(User::class)->findAll();
        $this->persist($userEvent);
    }

    public function persist(UserEvent $userEvent)
    {
        $this->em->persist($userEvent->getUser());
        $this->em->flush();
    }

    public static function getSubscribedEvents()
    {
        return [
            AppEvent::USER_ADD => array('add', 0),
        ];
    }
}