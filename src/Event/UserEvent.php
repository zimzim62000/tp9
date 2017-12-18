<?php
/**
 * Created by PhpStorm.
 * User: manuel
 * Date: 13/12/17
 * Time: 14:28
 */

namespace App\Event;


use Symfony\Component\EventDispatcher\Event;

class UserEvent extends Event
{
    protected $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}