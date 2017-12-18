<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tp_logusercard")
 */
class LogUserCard{
	const ACTION = ["ADD" => "Ajout", "SHOW" => "Affichage", "EDIT" => "Edition", "DELETE" => "Supprression"];
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string")
	 */
	private $action;
	
			/**
			 * @ORM\ManyToOne(targetEntity="User")
			 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
			 */
			private $user;
	
	/**
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="user_owner_id", referencedColumnName="id")
	 */
	private $userOwner;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Card")
	 * @ORM\JoinColumn(name="card_id", referencedColumnName="id")
	 */
	private $card;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	private $createdAd;
	
	/**
	 * LogUserCard constructor.
	 */
	public function __construct(){
		$this->createdAd = new \DateTime("now");
	}
	
	/**
	 * @return mixed
	 */
	public function getAction(){
		return $this->action;
	}
	
	/**
	 * @param mixed $action
	 */
	public function setAction($action){
		$this->action = $action;
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
	public function getCreatedAd(){
		return $this->createdAd;
	}
	
	/**
	 * @param mixed $createdAd
	 */
	public function setCreatedAd($createdAd){
		$this->createdAd = $createdAd;
	}
	
	/**
	 * @return mixed
	 */
	public function getId(){
		return $this->id;
	}
	
	/**
	 * @return mixed
	 */
	public function getUserOwner(){
		return $this->userOwner;
	}
	
	/**
	 * @param mixed $userOwner
	 */
	public function setUserOwner($userOwner){
		$this->userOwner = $userOwner;
	}
	
	
}