<?php
/**
 * Created by PhpStorm.
 * User: alexis.delarre
 * Date: 18/12/17
 * Time: 16:45
 */

namespace App\Event;

use App\Entity\NoteSkin;
use Symfony\Component\EventDispatcher\Event;

class NoteSkinEvent extends Event
{
    protected $NoteSkin;

    /**
     * NoteSkinEvent constructor.
     * @param $NoteSkin
     */
    public function __construct(NoteSkin $NoteSkin)
    {
        $this->NoteSkin = $NoteSkin;
    }

    /**
     * @param NoteSkin $NoteSkin
     */
    public function setNoteSkin($NoteSkin)
    {
        $this->NoteSkin = $NoteSkin;
    }

    /**
     * @return NoteSkin
     */
    public function getNoteSkin()
    {
        return $this->NoteSkin;
    }




}