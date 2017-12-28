<?php
/**
 * Created by PhpStorm.
 * User: thomasdebacker
 * Date: 18/12/2017
 * Time: 15:51
 */
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