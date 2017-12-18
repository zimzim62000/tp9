<?php
/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 18/12/2017
 * Time: 13:09
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tp_weapon_skin")
 */
class WeaponSkin{
	
	const BEAUTY = ["common"  => "common", "rare" => "rare", "épik" => "épik", "légendary" => "légendary"];
	const TYPE = ["sniper" => "sniper", "rifle" => "rifle", "pistol" => "pistol", "knife" => "knife"];
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", unique=true)
	 */
	private $name;
	
	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $text;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	private $createdAt;
	
	/**
	 * @ORM\Column(type="datetime")
	 */
	private $updatedAt;
	
	/**
	 * @ORM\Column(type="decimal", scale=2)
	 */
	private $price;
	
	/**
	 * @ORM\Column(type="string")
	 */
	private $beauty;
	
	/**
	 * @ORM\Column(type="string")
	 */
	private $type;
	/**
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private $user;
	
	/**
	 * WeaponSkin constructor.
	 * @param $createdAt
	 * @param $updatedAt
	 */
	public function __construct(){
		$this->createdAt = new \DateTime("now");
		$this->updatedAt = new \DateTime("now");
	}
	
	
	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->name;
	}
	
	/**
	 * @param mixed $name
	 */
	public function setName($name){
		$this->name = $name;
	}
	
	/**
	 * @return mixed
	 */
	public function getText(){
		return $this->text;
	}
	
	/**
	 * @param mixed $text
	 */
	public function setText($text){
		$this->text = $text;
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
	public function setCreatedAt($createdAt){
		$this->createdAt = $createdAt;
	}
	
	/**
	 * @return mixed
	 */
	public function getUpdatedAt(){
		return $this->updatedAt;
	}
	
	/**
	 * @return mixed
	 */
	public function getBeauty(){
		return $this->beauty;
	}
	
	/**
	 * @param mixed $beauty
	 */
	public function setBeauty($beauty){
		$this->beauty = $beauty;
	}
	
	/**
	 * @return mixed
	 */
	public function getType(){
		return $this->type;
	}
	
	/**
	 * @param mixed $type
	 */
	public function setType($type){
		$this->type = $type;
	}
	
	/**
	 * @param mixed $updatedAt
	 */
	public function setUpdatedAt($updatedAt){
		$this->updatedAt = $updatedAt;
	}
	
	/**
	 * @return mixed
	 */
	public function getPrice(){
		return $this->price;
	}
	
	/**
	 * @param mixed $price
	 */
	public function setPrice($price){
		$this->price = $price;
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
	public function getId(){
		return $this->id;
	}
}