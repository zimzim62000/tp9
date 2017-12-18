<?php
/**
 * Created by PhpStorm.
 * User: hadrienchatelet
 * Date: 18/12/2017
 * Time: 16:49
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class WeaponSkinEvent extends Event
{
    protected $skin;

    /**
     * @return mixed
     */
    public function getSkin()
    {
        return $this->skin;
    }

    /**
     * @param mixed $skin
     */
    public function setSkin($skin)
    {
        $this->skin = $skin;
    }
}