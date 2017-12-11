<?php

/**
 * Created by PhpStorm.
 * User: antoine.lefevre
 * Date: 04/12/17
 * Time: 15:41
 */

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class UserCardEvent extends Event
{
    private $usercard;

    /**
     * @return mixed
     */
    public function getUsercard()
    {
        return $this->usercard;
    }

    /**
     * @param mixed $usercard
     */
    public function setUsercard($usercard)
    {
        $this->usercard = $usercard;
    }




}