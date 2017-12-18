<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 13:18
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ds_noteskin")
 */
class NoteSkin
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $note;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="WeaponSkin")
     */
    private $skin;

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
    public function getNote()
    {
        return $this->note;
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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getSkin()
    {
        return $this->skin;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $skin
     */
    public function setSkin($skin)
    {
        $this->skin = $skin;
    }


}