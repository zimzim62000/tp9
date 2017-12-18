<?php

/**
 * Created by PhpStorm.
 * User: quentin.geeraert
 * Date: 18/12/17
 * Time: 15:23
 */


namespace App\Event;
use Symfony\Component\EventDispatcher\Event;

class SkinNoteEvent extends Event
{
    private $skinnote;

    /**
     * @return mixed
     */
    public function getSkinnote()
    {
        return $this->skinnote;
    }

    /**
     * @param mixed $skinnote
     */
    public function setSkinnote($skinnote)
    {
        $this->skinnote = $skinnote;
    }


}