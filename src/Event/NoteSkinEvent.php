<?php

namespace App\Event;

use App\Entity\NoteSkin;
use Symfony\Component\EventDispatcher\Event;


/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 15:17
 */
class NoteSkinEvent extends Event
{
    /**
     * @var NoteSkin
     */
    private $noteSkin;

    /**
     * @return NoteSkin
     */
    public function getNoteSkin()
    {
        return $this->noteSkin;
    }

    /**
     * @param NoteSkin $noteSkin
     */
    public function setNoteSkin($noteSkin)
    {
        $this->noteSkin = $noteSkin;
    }
}