<?php
/**
 * Created by PhpStorm.
 * User: emanuelevella
 * Date: 11/12/2017
 * Time: 14:56
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;



class UserCardEvent extends Event{
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