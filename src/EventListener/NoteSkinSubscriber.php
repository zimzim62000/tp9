<?php

namespace App\EventListener;

use App\AppEvent;
use App\Entity\NoteSkin;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class NoteSkinSubscriber implements EventSubscriberInterface {

    private $em;
    private $noteSkin;
    private $token;

    /**
     * NoteSkinSubscriber constructor.
     * @param $em
     * @param $noteSkin
     * @param $token
     */
    public function __construct($em, $noteSkin, $token)
    {
        $this->em = $em;
        $this->noteSkin = $noteSkin;
        $this->token = $token;
    }


    public static function getSubscribedEvents() {
        return [
            AppEvent::NOTE_SKIN_ADD => array('add', 0),
            AppEvent::NOTE_SKIN_EDIT => array('update', 0),
            AppEvent::NOTE_SKIN_DELETE => array('remove', 0),
        ];
    }


    public function add(NoteSkin $noteSkin) {
        $email="admin@admin.fr";
        $subject = "";
        $text = "";
        $this->mail($email, $subject, $text);
        $this->persist($noteSkin, 'ADD');
    }

    public function edit(NoteSkin $noteSkin) {
        $this->persist($noteSkin, 'EDIT');
    }

    public function delete(NoteSkin $noteSkin) {
        $email= $this->getUser()->getEmail();
        $subject = "";
        $text = "";
        $this->mail($email, $subject, $text);
        $this->persist($noteSkin, 'DELETE');
    }

    public function persist(NoteSkinEvent $noteSkinEvent, $type)
    {
        $this->em->persist($this->noteSkin);
        $this->em->flush();
    }
}