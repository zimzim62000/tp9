<?php
/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 11/12/2017
 * Time: 23:26
 */

namespace App\Event;


use App\Entity\LogUserCard;
use App\Entity\UserCard;
use Symfony\Component\EventDispatcher\Event;

class LogUserCardEvent extends Event{
	
	private $logUserCard;
	
	public function __construct(LogUserCard $logUserCard){
		$this->logUserCard = $logUserCard;
	}
	
	/**
	 * @return mixed
	 */
	public function getLogUserCard(){
		return $this->logUserCard;
	}
	
	/**
	 * @param mixed $logUserCard
	 */
	public function setLogUserCard($logUserCard){
		$this->logUserCard = $logUserCard;
	}
	
	
}