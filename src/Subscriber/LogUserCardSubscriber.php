<?php

namespace App\Subscriber;

use App\Entity\LogUserCard;
use App\Event\AppEvent;
use App\Event\LogUserCardEvent;
use App\Event\UserCardEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 11/12/2017
 * Time: 21:28
 */

class LogUserCardSubscriber implements EventSubscriberInterface{
	
	private $manager;
	
	public function __construct(EntityManagerInterface $entityManager){
		$this->manager = $entityManager;
	}
	
	public static function getSubscribedEvents(){
		return [
			AppEvent::LOG_USER_CARD_ADD => 'logUserCardAdd',
			AppEvent::LOG_USER_CARD_EDIT => 'logUserCardEdit',
			AppEvent::LOG_USER_CARD_DELETE => 'logUserCardDelete',
			AppEvent::LOG_USER_CARD_SHOW => 'logUserCardShow'
		];
	}
	
	public function logUserCardAdd(LogUserCardEvent $logUserCardEvent){
		
		/** @var LogUserCard $logUserCard */
		$logUserCard = $logUserCardEvent->getLogUserCard();
		$logUserCard->setAction(LogUserCard::ACTION["ADD"]);
		
		$this->manager->persist($logUserCard);
		$this->manager->flush();
		
	}
	
	public function logUserCardEdit(LogUserCardEvent $logUserCardEvent){
		
		/** @var LogUserCard $logUserCard */
		$logUserCard = $logUserCardEvent->getLogUserCard();
		$logUserCard->setAction(LogUserCard::ACTION["EDIT"]);
		
		$this->manager->persist($logUserCard);
		$this->manager->flush();
		
	}
	
	public function logUserCardDelete(LogUserCardEvent $logUserCardEvent){
		
		/** @var LogUserCard $logUserCard */
		$logUserCard = $logUserCardEvent->getLogUserCard();
		$logUserCard->setAction(LogUserCard::ACTION["DELETE"]);
		
		$this->manager->persist($logUserCard);
		$this->manager->flush();
		
	}
	
	public function logUserCardShow(LogUserCardEvent $logUserCardEvent){
		
		/** @var LogUserCard $logUserCard */
		$logUserCard = $logUserCardEvent->getLogUserCard();
		$logUserCard->setAction(LogUserCard::ACTION["SHOW"]);
		
		$this->manager->persist($logUserCard);
		$this->manager->flush();
		
	}

}