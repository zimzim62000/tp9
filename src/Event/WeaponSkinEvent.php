<?php

namespace App\Event;

use App\Entity\WeaponSkin;
use Symfony\Component\EventDispatcher\Event;

class WeaponSkinEvent extends Event
{
   protected $WeaponSkin;

    /**
     * WeaponSkinEvent constructor.
     * @param $WeaponSkin
     */
    public function __construct(WeaponSkin $WeaponSkin)
    {
        $this->WeaponSkin = $WeaponSkin;
    }


    /**
     * @return mixed
     */
    public function getWeaponSkin()
    {
        return $this->WeaponSkin;
    }



}