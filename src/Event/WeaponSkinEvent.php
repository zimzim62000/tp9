<?php

namespace App\Event;

use App\Entity\WeaponSkin;
use Symfony\Component\EventDispatcher\Event;

class WeaponSkinEvent extends Event {
    protected $weaponSkin;

    public function getWeaponSkin()
    {
        return $this->weaponSkin;
    }

    public function setWeaponSkin(WeaponSkin $weaponSkin)
    {
        $this->weaponSkin = $weaponSkin;
    }
}