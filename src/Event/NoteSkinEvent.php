<?php

namespace App\Event;

class NoteSkinEvent extends \Symfony\Component\EventDispatcher\Event
{
    private $noteskin;

    /**
     * @return mixed
     */
    public function getNoteskin()
    {
        return $this->noteskin;
    }

    /**
     * @param mixed $noteskin
     */
    public function setNoteskin($noteskin)
    {
        $this->noteskin = $noteskin;
    }
}