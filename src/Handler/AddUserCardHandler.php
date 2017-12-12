<?php

namespace App\Handler;

use App\Entity\UserCard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AddUserCardHandler{

	private $maxCard;
	private $manager;
	private $storage;
	
	public function __construct($maxCard, EntityManagerInterface $entityManager, TokenStorageInterface $storage){
		$this->maxCard = $maxCard;
		$this->manager = $entityManager;
		$this->storage = $storage;
	}
	
	public function checkNumberCard(){
		$userCard = $this->manager->getRepository(UserCard::class)->findBy(["user" => $this->storage->getToken()->getUser()]);
		
		return count($userCard) < $this->maxCard;
	}
}