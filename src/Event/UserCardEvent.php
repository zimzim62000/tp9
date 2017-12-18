<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 11/12/2017
 * Time: 21:26
 */

class UserCardEvent extends Event{
	
	protected $userCard;
	
	/**
	 * @return mixed
	 */
	public function getUserCard(){
		return $this->userCard;
	}
	
	/**
	 * @param mixed $userCard
	 */
	public function setUserCard($userCard){
		$this->userCard = $userCard;
	}
}