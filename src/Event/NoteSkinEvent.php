<?php

/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 18/12/17
 * Time: 17:11
 */
namespace App\Event;

use Composer\EventDispatcher\Event;

class NoteSkinEvent extends Event
{
    /**
     * @var \App\Entity\NoteSkin
     */
    private $noteSkin;

    /**
     * @return \App\Entity\NoteSkin
     */
    public function getNoteSkin(): \App\Entity\NoteSkin
    {
        return $this->noteSkin;
    }

    /**
     * @param \App\Entity\NoteSkin $noteSkin
     */
    public function setNoteSkin(\App\Entity\NoteSkin $noteSkin)
    {
        $this->noteSkin = $noteSkin;
    }

}
