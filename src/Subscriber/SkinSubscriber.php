<?php

namespace App\Subscriber;

use App\Event\AppEvent;
use App\Event\SkinEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SkinSubscriber implements EventSubscriberInterface{
	
	private $manager;
	
	public function __construct(EntityManagerInterface $entityManager){
		$this->manager = $entityManager;
	}
	
	public static function getSubscribedEvents(){
		return [
			AppEvent::SKIN_ADD => 'SkinAdd',
			AppEvent::SKIN_EDIT => 'SkinEdit',
		];
	}
	
	public function SkinAdd(SkinEvent $skinEvent){
		
		$noteSkin = $skinEvent->getSkin();
		
		$this->manager->persist($noteSkin);
		$this->manager->flush();
		
	}
	
	public function SkinEdit(SkinEvent $skinEvent){
		
		$noteSkin = $skinEvent->getSkin();
		
		$this->manager->persist($noteSkin);
		$this->manager->flush();
	}
	
}