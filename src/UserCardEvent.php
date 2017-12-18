<?php

namespace App;

use Symfony\Component\EventDispatcher\Event;

class UserCardEvent extends Event
{
    private $userCard;

    /**
     * @return mixed
     */
    public function getUserCard()
    {
        return $this->userCard;
    }

    /**
     * @param mixed $userCard
     */
    public function setUserCard($userCard)
    {
        $this->userCard = $userCard;
    }
}