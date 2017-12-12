<?php

namespace App\Subscriber;

use App\Event\AppEvent;
use App\Event\UserCardEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 11/12/2017
 * Time: 21:28
 */

class UserCardSubscriber implements EventSubscriberInterface{
	
	private $manager;
	
	public function __construct(EntityManagerInterface $entityManager){
		$this->manager = $entityManager;
	}
	
	public static function getSubscribedEvents(){
		return [
			AppEvent::USER_CARD_ADD => 'userCardAdd',
			AppEvent::USER_CARD_EDIT => 'userCardEdit',
			AppEvent::USER_CARD_DELETE => 'userCardDelete'
		];
	}
	
	public function userCardAdd(UserCardEvent $userCardEvent){
		
		$userCard = $userCardEvent->getUserCard();
		
		$this->manager->persist($userCard);
		$this->manager->flush();
		
	}
	
	public function userCardEdit(UserCardEvent $userCardEvent){
		
		$userCard = $userCardEvent->getUserCard();
		
		$this->manager->persist($userCard);
		$this->manager->flush();
	}
	
	public function userCardDelete(UserCardEvent $userCardEvent){
		
		$userCard = $userCardEvent->getUserCard();
		
		$this->manager->remove($userCard);
		$this->manager->flush();
	}
}