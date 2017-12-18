<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 11/12/2017
 * Time: 21:26
 */

class NoteSkinEvent extends Event{
	
	protected $noteSkin;
	
	/**
	 * @return mixed
	 */
	public function getNoteSkin(){
		return $this->noteSkin;
	}
	
	/**
	 * @param mixed $noteSkin
	 */
	public function setNoteSkin($noteSkin){
		$this->noteSkin = $noteSkin;
	}
}