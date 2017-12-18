<?php
/**
 * Created by PhpStorm.
 * User: alexis.delarre
 * Date: 13/12/17
 * Time: 09:21
 */

namespace App\EventListener;


use App\AppEvent;
use App\Entity\WeaponSkin;
use App\Event\WeaponSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class WeaponSkinSubscriber implements EventSubscriberInterface
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
            AppEvent::WEAPON_SKIN_ADD => array('add', 0),
            AppEvent::WEAPON_SKIN_DELETE =>array("remove",0),
            AppEvent::WEAPON_SKIN_EDIT => array ("edit",0)

        ];
    }

    public function add(WeaponSkinEvent $weaponEvent)
    {
        $user = $weaponEvent->getWeaponSkin();
        $this->em->persist($user);
        $this->em->flush();
    }

    public function persist(WeaponSkinEvent $weaponEvent)
    {
        $this->em->persist($weaponEvent->getWeaponSkin());
        $this->em->flush();
    }

    public function remove(WeaponSkinEvent $weaponEvent)
    {
        $this->em->remove($weaponEvent->getWeaponSkin());
        $this->em->flush();
    }
}