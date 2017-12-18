<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 18/12/17
 * Time: 13:14
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="tp_noteSkin")
 */
class NoteSkin
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @var float
     * @ORM\Column(type="decimal", scale=2)
     * @Assert\NotBlank()
     */
    protected $note;
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $created_at;
    /**
     * @var User
     * @ORM\OneToOne(targetEntity="User")
     */
    protected $user;
    /**
     * @var WeaponSkin
     * @ORM\ManyToOne(targetEntity="WeaponSkin")
     */
    protected $skin;

    /**
     * @return float
     */
    public function getNote(): float
    {
        return $this->note;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param float $note
     */
    public function setNote(float $note)
    {
        $this->note = $note;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     */
    public function setCreatedAt(\DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return WeaponSkin
     */
    public function getSkin(): WeaponSkin
    {
        return $this->skin;
    }

    /**
     * @param WeaponSkin $skin
     */
    public function setSkin(WeaponSkin $skin)
    {
        $this->skin = $skin;
    }
}