<?php

namespace App\Subscriber;

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

class NoteSkinSubscriber implements EventSubscriberInterface{
	
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
		
		$noteSkin = $noteSkinEvent->getNoteSkin();
		
		$this->manager->persist($noteSkin);
		$this->manager->flush();
		
	}
	
	public function noteSkinEdit(NoteSkinEvent $noteSkinEvent){
		
		$noteSkin = $noteSkinEvent->getNoteSkin();
		
		$this->manager->persist($noteSkin);
		$this->manager->flush();
	}
	
	public function noteSkinDelete(NoteSkinEvent $noteSkinEvent){
		
		$noteSkin = $noteSkinEvent->getNoteSkin();
		
		$this->manager->remove($noteSkin);
		$this->manager->flush();
	}
}