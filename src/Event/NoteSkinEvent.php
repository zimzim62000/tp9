<?php
/**
 * Created by PhpStorm.
 * User: emanuelevella
 * Date: 18/12/2017
 * Time: 16:10
 */
namespace App\Event;

use App\Entity\NoteSkin;
use Symfony\Component\EventDispatcher\Event;

class NoteSkinEvent extends Event
{
    protected $note;

    public function getNoteSkin()
    {
        return $this->note;
    }

    public function setNoteSkin(NoteSkin $noteSkin)
    {
        $this->note = $noteSkin;
    }
}