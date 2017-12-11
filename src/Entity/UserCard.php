<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tp_usercard")
 */
class UserCard{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $actionPoint;

    /**
     * @ORM\Column(type="integer")
     */
    private $attack;

    /**
     * @ORM\Column(type="integer")
     */
    private $defence;


    /**
     * @ORM\ManyToOne(targetEntity="Card")
     */
    private $card;

    /**
     *  @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @return mixed
     */
    public function getActionPoint()
    {
        return $this->actionPoint;
    }

    /**
     * @param mixed $actionPoint
     */
    public function setActionPoint($actionPoint)
    {
        $this->actionPoint = $actionPoint;
    }

    /**
     * @return mixed
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * @param mixed $attack
     */
    public function setAttack($attack)
    {
        $this->attack = $attack;
    }

    /**
     * @return mixed
     */
    public function getDefence()
    {
        return $this->defence;
    }

    /**
     * @param mixed $defence
     */
    public function setDefence($defence)
    {
        $this->defence = $defence;
    }

    /**
     * @return mixed
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param mixed $card
     */
    public function setCard($card)
    {
        $this->card = $card;
    }

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