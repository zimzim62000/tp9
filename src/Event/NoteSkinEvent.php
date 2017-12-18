<?php

namespace App\Event;

use App\Entity\NoteSkin;
use Symfony\Component\EventDispatcher\Event;

class NoteSkinEvent extends Event
{
    protected $noteSkin;

    public function getNoteSkin()
    {
        return $this->noteSkin;
    }

    public function setNoteSkin(NoteSkin $noteSkin)
    {
        $this->noteSkin = $noteSkin;
    }
}