<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="tpfinal")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     *
     */
    protected $email;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isAdmin = false;

    public function __construct()
    {
        $this->createdAt = $this->updatedAt = new \DateTime();
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getEmail() : ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email) : void
    {
        $this->email = $email;
    }

    public function getPassword() : ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password) : void
    {
        $this->password = $password;
    }

    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt() : \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt) : void
    {
        $this->updatedAt = $updatedAt;
    }

    public function isAdmin() : bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin) : void
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        $roles = ['ROLE_USER'];

        if ($this->isAdmin()) {
            $roles[] = 'ROLE_ADMIN';
        }

        return $roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->email,
            $this->isAdmin,
            $this->password,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->email,
            $this->isAdmin,
            $this->password) = unserialize($serialized);
    }
}
