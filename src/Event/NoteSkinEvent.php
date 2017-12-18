<?php
/**
 * Created by PhpStorm.
 * User: hadrienchatelet
 * Date: 18/12/2017
 * Time: 15:38
 */

namespace App\Event;


use Symfony\Component\EventDispatcher\Event;

class NoteSkinEvent extends Event
{
    protected $note;

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