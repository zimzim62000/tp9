<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 16/12/2017
 * Time: 21:11
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class SkinEvent extends Event
{
    private $skin;

    /**
     * @return mixed
     */
    public function getSkin()
    {
        return $this->skin;
    }

    /**
     * @param mixed $noteskin
     */
    public function setSkin($skin)
    {
        $this->skin = $skin;
    }

}