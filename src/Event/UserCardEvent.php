<?php

/**
 * Created by PhpStorm.
 * User: nael.durand
 * Date: 04/12/17
 * Time: 15:41
 */
namespace App\Event;
use Symfony\Component\EventDispatcher\Event;

class UserCardEvent extends Event{
    private $usercard;



    /**
     * @return mixed
     */
    public function getUserCard()
    {
        return $this->usercard;
    }

    /**
     * @param mixed $player
     */
    public function setUserCard($usercard)
    {
        $this->usercard = $usercard;
    }


}

