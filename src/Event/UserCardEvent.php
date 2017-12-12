<?php
/**
 * Created by PhpStorm.
 * User: thomasdebacker
 * Date: 11/12/2017
 * Time: 15:12
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