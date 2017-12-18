<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 18/12/17
 * Time: 15:38
 */

namespace App\Event;


use Symfony\Component\EventDispatcher\Event;

class NoteSkinEvent extends Event
{
    protected $noteSkin;

    /**
     * @return mixed
     */
    public function getNoteSkin()
    {
        return $this->noteSkin;
    }

    /**
     * @param mixed $noteSkin
     */
    public function setNoteSkin($noteSkin)
    {
        $this->noteSkin = $noteSkin;
    }


}