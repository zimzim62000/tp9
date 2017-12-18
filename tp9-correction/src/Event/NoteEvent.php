<?php

namespace App\Event;

use App\Entity\NoteSkin;
use Symfony\Component\EventDispatcher\Event;

class NoteEvent extends Event
{
    protected $note;

    /**
     * @return NoteSkin
     */
    public function getNote()
    {
        return $this->note;
    }

    public function setNote(NoteSkin $note)
    {
        $this->note = $note;
    }
}