<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 04/12/17
 * Time: 15:36
 */

namespace App\Event;
use App\Entity\UserCard;
use Symfony\Component\EventDispatcher\Event;

class UserCardEvent extends Event{

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