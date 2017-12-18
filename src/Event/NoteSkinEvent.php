<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class NoteSkinEvent extends Event
{
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


}