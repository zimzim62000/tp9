<?php

namespace App\EventListener;

use App\AppEvent;
use App\Entity\WeaponSkin;
use App\Event\WeaponSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class WeaponSkinSubscriber implements EventSubscriberInterface {

    private $em;
    private $weaponSkin;
    private $token;

    /**
     * NoteSkinSubscriber constructor.
     * @param $em
     * @param $weaponSkin
     * @param $token
     */
    public function __construct($em, $weaponSkin, $token)
    {
        $this->em = $em;
        $this->noteSkin = $weaponSkin;
        $this->token = $token;
    }


    public static function getSubscribedEvents() {
        return [
            AppEvent::WEAPONS_SKIN_ADD => array('add', 0),
            AppEvent::WEAPONS_SKIN_EDIT => array('update', 0)
        ];
    }


    public function add(WeaponSkin $weaponSkin) {
        $this->persist($weaponSkin, 'ADD');
    }

    public function edit(WeaponSkin $weaponSkin) {
        $this->persist($weaponSkin, 'EDIT');
    }

    public function delete(WeaponSkin $weaponSkin) {
        $this->persist($weaponSkin, 'DELETE');
    }

    public function persist(WeaponSkinEvent $weaponSkinEvent, $type)
    {
        $this->em->persist($this->weaponSkin);
        $this->em->flush();
    }
}