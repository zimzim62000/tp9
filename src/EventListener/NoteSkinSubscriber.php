<?php
/**
 * Created by PhpStorm.
 * User: hadrienchatelet
 * Date: 18/12/2017
 * Time: 15:40
 */

namespace App\EventListener;


use App\AppEvent;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NoteSkinSubscriber implements EventSubscriberInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    public static function getSubscribedEvents()
    {
        return[
            AppEvent::NOTE_ADD => array('add', 0),
            AppEvent::NOTE_EDIT => array('edit', 0),
            AppEvent::NOTE_DEL => array('delete', 0),
        ];
    }

    public function add(NoteSkinEvent $skinEvent)
    {
        $note = $skinEvent->getNote();
        $this->entityManager->persist($note);
        //\mail("admin@admin.fr", "Ajout d'une note", "Nouvelle note ajoutée");
        $this->entityManager->flush();
    }

    public function edit(NoteSkinEvent $skinEvent)
    {
        $this->entityManager->persist($skinEvent->getNote());
        $this->entityManager->flush();
    }

    public function delete(NoteSkinEvent $skinEvent)
    {
        $this->entityManager->remove($skinEvent->getNote());
        $this->entityManager->flush();
    }

}