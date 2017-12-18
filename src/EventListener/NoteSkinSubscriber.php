<?php

namespace App\EventListener;

use App\Entity\User;
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



class NoteSkinSubscriber implements EventSubscriberInterface
{
    private $em;

    /**
     * NoteSkinSubscriber constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }


    public static function getSubscribedEvents()
    {
        return [
            AppEvent::NOTE_SKIN_ADD => 'create',
            AppEvent::NOTE_SKIN_EDIT => 'edit',
            AppEvent::NOTE_SKIN_DELETE => 'delete',
        ];
    }


    public function create(NoteSkinEvent $noteSkinEvent){
        $user = $noteSkinEvent->getUser();
        $weaponSkin = $noteSkinEvent->getWeaponSkin();
        $note = $noteSkinEvent->getNote();

        $noteSkin = new NoteSkin();
        $noteSkin->setUser($user);
        $noteSkin->setWeaponSkin($weaponSkin);
        $noteSkin->setNote($note);

        $mailAdmins = $this->em->getRepository(User::class)->findBy(['admin' => true]);

        foreach ($mailAdmins as $mailAdmin){
            \Monolog\Handler\mail($mailAdmin,"Creation new note", "Ajout d'une note sur un skin");
        }


        $this->em->persist($noteSkin);

        $this->em->flush();

    }

    public function edit(NoteSkinEvent $noteSkinEvent){
        $note = $this->em->getRepository(NoteSkin::class)->findBy(['user_id' => $noteSkinEvent->getUser(), 'weaponskin_id' => $noteSkinEvent->getWeaponSkin()]);
        /** @var NoteSkin $note */
        $note->setNote($noteSkinEvent->getNote());
        $this->em->persist($note);
        $this->em->flush();
    }


    public function delete(NoteSkinEvent $noteSkinEvent){

    }
}