<?php

namespace App\Subscriber;

use App\Entity\User;
use App\Event\AppEvent;
use App\Event\NoteSkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 18/12/2017
 * Time: 14:55
 */

class EmailSubscriber implements EventSubscriberInterface{
	
	private $manager;
	
	public function __construct(EntityManagerInterface $entityManager){
		$this->manager = $entityManager;
	}
	
	public static function getSubscribedEvents(){
		return [
			AppEvent::NOTE_SKIN_ADD => 'noteSkinAdd',
			AppEvent::NOTE_SKIN_EDIT => 'noteSkinEdit',
			AppEvent::NOTE_SKIN_DELETE => 'noteSkinDelete'
		];
	}
	
	public function noteSkinAdd(NoteSkinEvent $noteSkinEvent){

		$users = $this->manager->getRepository(User::class)->findAll();
		
		$message = $noteSkinEvent->getNoteSkin()->getUser()->getFirstname() . " a ajouté une note";
		foreach($users as $user){
			if($user->isAdmin()){/*
				\Mail($noteSkinEvent->getNoteSkin()->getUser()->getEmail(),
					"Ajout d'une note", $message);*/
			}
		}
	}
	
	public function noteSkinEdit(NoteSkinEvent $noteSkinEvent){
		/*\Mail($noteSkinEvent->getNoteSkin()->getUser()->getEmail(),
			"Edition d'une note",
			"Un admin a édité une de vos notes");
	*/
	}
	
	public function noteSkinDelete(NoteSkinEvent $noteSkinEvent){
	/*	\Mail($noteSkinEvent->getNoteSkin()->getUser()->getEmail(),
			"Suppression d'une note",
			"Un admin a supprimé une de vos notes");
	*/
	}
}
