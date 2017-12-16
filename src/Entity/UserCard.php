<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="tp_usercard")
 */
class UserCard{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="integer")
	 * @Assert\NotBlank(message="Veuillez entrer une valeur pour l'attaque")
	 * @Assert\Type("integer", message="Le type n'est pas autorisé")
	 */
	private $attack;

	/**
	 * @ORM\Column(type="integer")
	 * @Assert\NotBlank(message="Veuillez entrer une valeur pour la defense")
	 * @Assert\Type("integer", message="Le type n'est pas autorisé")
	 */
	private $defense;
	
	/**
	 * @ORM\Column(type="integer")
	 * @Assert\NotBlank(message="Veuillez entrer une valeur pouur l'action point")
	 * @Assert\Type("integer", message="Le type n'est pas autorisé")
	 */
	private $actionPoint;
	
	/**
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private $user;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Card")
	 * @ORM\JoinColumn(name="card_id", referencedColumnName="id")
	 */
	private $card;
	
	/**
	 * @return mixed
	 */
	public function getAttack(){
		return $this->attack;
	}
	
	/**
	 * @param mixed $attack
	 */
	public function setAttack($attack){
		$this->attack = $attack;
	}
	
	/**
	 * @return mixed
	 */
	public function getDefense(){
		return $this->defense;
	}
	
	/**
	 * @param mixed $defense
	 */
	public function setDefense($defense){
		$this->defense = $defense;
	}
	
	/**
	 * @return mixed
	 */
	public function getActionPoint(){
		return $this->actionPoint;
	}
	
	/**
	 * @param mixed $actionPoint
	 */
	public function setActionPoint($actionPoint){
		$this->actionPoint = $actionPoint;
	}
	
	/**
	 * @return mixed
	 */
	public function getUser(){
		return $this->user;
	}
	
	/**
	 * @param mixed $user
	 */
	public function setUser($user){
		$this->user = $user;
	}
	
	/**
	 * @return mixed
	 */
	public function getCard(){
		return $this->card;
	}
	
	/**
	 * @param mixed $card
	 */
	public function setCard($card){
		$this->card = $card;
	}
	
	/**
	 * @return mixed
	 */
	public function getId(){
		return $this->id;
	}
}