<?php
/**
 * Created by PhpStorm.
 * User: alexis.delarre
 * Date: 18/12/17
 * Time: 13:22
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="tp_WeaponSkin")
 */
class WeaponSkin
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $text;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAd;
    /**
     * @ORM\Column(type="string")
     */
    private $beauty;
    /**
     * @ORM\Column(type="string")
     */
    private $type;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updateAd = new \DateTime();
    }

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
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdateAd()
    {
        return $this->updateAd;
    }

    /**
     * @param mixed $updateAd
     */
    public function setUpdateAd($updateAd)
    {
        $this->updateAd = $updateAd;
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