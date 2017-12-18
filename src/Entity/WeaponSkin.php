<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 13:09
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ds_weaponskin")
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
     * @ORM\Column(type="string", unique=true)
     */
    private $name;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;
    /**
     * @ORM\Column(type="datetime")
     */
    private $update_at;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    /**
     * @return mixed
     */
    public function getBeauty()
    {
        return $this->beauty;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @param mixed $update_at
     */
    public function setUpdateAt($update_at)
    {
        $this->update_at = $update_at;
    }

    /**
     * @param mixed $beauty
     */
    public function setBeauty($beauty)
    {
        $this->beauty = $beauty;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}