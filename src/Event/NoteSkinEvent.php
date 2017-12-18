<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 18/12/17
 * Time: 15:11
 */

use Symfony\Component\EventDispatcher\Event;
namespace App;


class NoteSkinEvent extends Event
{
    private $user;
    private $weaponSkin;
    private $note;

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }



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