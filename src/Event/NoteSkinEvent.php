<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 16/12/2017
 * Time: 21:11
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class NoteSkinEvent extends Event
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