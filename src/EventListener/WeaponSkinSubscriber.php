<?php

namespace App\EventListener;

use App\Entity\User;
use App\Entity\WeaponSkin;
use App\Event\WeaponSkinEvent;
use App\NoteSkinEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


use App\AppEvent;
use App\Entity\NoteSkin;
use Doctrine\ORM\EntityManagerInterface;
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 18/12/17
 * Time: 15:13
 */



class WeaponSkinSubscriber implements EventSubscriberInterface
{
    private $em;

    /**
     * WeaponSkinSubscriber constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }


    public static function getSubscribedEvents()
    {
        return [
            AppEvent::WEAPON_SKIN_ADD => 'create',
            AppEvent::WEAPON_SKIN_EDIT => 'edit',
        ];
    }


    public function create(WeaponSkinEvent $weaponSkinEvent){
        $user = $weaponSkinEvent->getUser();


        $this->em->flush();

    }

    public function edit(WeaponSkinEvent $noteSkinEvent){
        $note = $this->em->getRepository(NoteSkin::class)->findBy(['user_id' => $noteSkinEvent->getUser(), 'weaponskin_id' => $noteSkinEvent->getWeaponSkin()]);
        /** @var NoteSkin $note */
        $note->setNote($noteSkinEvent->getNote());
        $this->em->persist($note);
        $this->em->flush();
    }


}