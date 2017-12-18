<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="weapons_skins")
 */
class WeaponSkin {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $name;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;
    /**
     * @ORM\Column(type="date")
     */
    private $created_at;
    /**
     * @ORM\Column(type="date")
     */
    private $uploaded_at;
    /**
     * @Assert\Choice({"common", "rare", "épik", "légendary"})
     */
    private $beauty;
    /**
     * @Assert\Choice({"sniper", "rifle", "pistol", "knife"})
     */
    private $type;
    /**
     * @ORM\Column(type="int", scale=2)
     */
    private $price;
    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="user_skins",
     *   joinColumns={@ORM\JoinColumn(name="weapons_skins_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="users_id", referencedColumnName="id")}
     * )
     *
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUploadedAt()
    {
        return $this->uploaded_at;
    }

    /**
     * @param mixed $uploaded_at
     */
    public function setUploadedAt($uploaded_at)
    {
        $this->uploaded_at = $uploaded_at;
    }

    /**
     * @return mixed
     */
    public function getBeauty()
    {
        return $this->beauty;
    }

    /**
     * @param mixed $beauty
     */
    public function setBeauty($beauty)
    {
        $this->beauty = $beauty;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
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