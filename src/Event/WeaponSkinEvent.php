<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 18/12/17
 * Time: 15:11
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;



class WeaponSkinEvent extends Event
{
    private $user;
    private $weaponSkin;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getWeaponSkin()
    {
        return $this->weaponSkin;
    }

    /**
     * @param mixed $weaponSkin
     */
    public function setWeaponSkin($weaponSkin)
    {
        $this->weaponSkin = $weaponSkin;
    }



}