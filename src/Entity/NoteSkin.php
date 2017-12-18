<?php
/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 18/12/2017
 * Time: 13:18
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="tp_note_skin")
 */
class NoteSkin{
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="decimal", scale=2)
	 * @Assert\GreaterThanOrEqual(0)
	 * @Assert\LessThanOrEqual(20)
	 */
	private $note;
	
	/**
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private $user;
	
	/**
	 * @ORM\ManyToOne(targetEntity="WeaponSkin")
	 * @ORM\JoinColumn(name="weapon_skin_id", referencedColumnName="id")
	 */
	private $weaponSkin;
	
	/**
	 * NoteSkin constructor.
	 * @param $note
	 */
	public function __construct(){
		$this->createdAt = new \DateTime("now");
	}
	
	/**
	 * @return mixed
	 */
	public function getCreatedAt(){
		return $this->createdAt;
	}
	
	/**
	 * @param mixed $createdAt
	 */
	public function setCreatedAt($createdAt): void{
		$this->createdAt = $createdAt;
	}
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	private $createdAt;
	
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
	public function getWeaponSkin(){
		return $this->weaponSkin;
	}
	
	/**
	 * @param mixed $weaponSkin
	 */
	public function setWeaponSkin($weaponSkin){
		$this->weaponSkin = $weaponSkin;
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
	public function getNote(){
		return $this->note;
	}
	
	/**
	 * @param mixed $note
	 */
	public function setNote($note){
		$this->note = $note;
	}
}