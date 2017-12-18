<?php
namespace App\Event;
use App\Entity\NoteSkin;
use Symfony\Component\EventDispatcher\Event;

class NoteSkinEvent extends Event
{
    protected $note;
    public function getNote()
    {
        return $this->note;
    }
    public function setNote(NoteSkin $note)
    {
        $this->note = $note;
    }
}