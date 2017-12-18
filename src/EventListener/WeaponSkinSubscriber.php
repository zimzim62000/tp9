<?php
/**
 * Created by PhpStorm.
 * User: hadrienchatelet
 * Date: 18/12/2017
 * Time: 16:50
 */

namespace App\EventListener;

use App\AppEvent;
use App\Event\WeaponSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WeaponSkinSubscriber
{
    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    public static function getSubscribedEvents()
    {
        return[
            AppEvent::WEAPON_ADD => array('add', 0),
            AppEvent::WEAPON_EDIT => array('edit', 0),
            AppEvent::WEAPON_DEL => array('delete', 0),
        ];
    }

    public function add(WeaponSkinEvent $weaponSkinEvent)
    {
        $skin = $weaponSkinEvent->getNote();
        $this->entityManager->persist($skin);
        $this->entityManager->flush();
    }

    public function edit(WeaponSkinEvent $weaponSkinEvent)
    {
        $this->entityManager->persist($weaponSkinEvent->getNote());
        $this->entityManager->flush();
    }

    public function delete(WeaponSkinEvent $weaponSkinEvent)
    {
        $this->entityManager->remove($weaponSkinEvent->getNote());
        $this->entityManager->flush();
    }
}