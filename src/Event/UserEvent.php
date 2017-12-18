<?php
/**
 * Created by PhpStorm.
 * User: alexis.delarre
 * Date: 13/12/17
 * Time: 09:17
 */

namespace App\Event;


use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;


class UserEvent extends Event
{
    protected $user;

    /**
     * UserEvent constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }



}