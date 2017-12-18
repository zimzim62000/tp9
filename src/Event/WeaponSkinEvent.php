<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 17:19
 */

namespace App\Event;

use App\Entity\WeaponSkin;
use Symfony\Component\EventDispatcher\Event;

class WeaponSkinEvent extends Event
{
    /**
     * @var $weaponSkin WeaponSkin
     */
    private $weaponSkin;

    /**
     * @return WeaponSkin
     */
    public function getWeaponSkin()
    {
        return $this->weaponSkin;
    }

    /**
     * @param WeaponSkin $weaponSkin
     */
    public function setWeaponSkin($weaponSkin)
    {
        $this->weaponSkin = $weaponSkin;
    }


}