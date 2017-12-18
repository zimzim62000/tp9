<?php

namespace App\Event;

use App\Entity\WeaponSkin;
use Symfony\Component\EventDispatcher\Event;

/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 11/12/2017
 * Time: 21:26
 */

class SkinEvent extends Event{
	
	/**
	 * @var WeaponSkin
	 */
	protected $skin;
	
	/**
	 * @return mixed
	 */
	public function getSkin(){
		return $this->skin;
	}
	
	/**
	 * @param mixed $skin
	 */
	public function setSkin($skin){
		$this->skin = $skin;
	}
}