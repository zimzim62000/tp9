<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface, \Serializable
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
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin = false;


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

    public function __construct()
    {
        $this->createdAt = $this->updatedAt = new \DateTime();
    }

    public function getPassword() : ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password) : void
    {
        $this->password = $password;
    }

    public function isAdmin() : bool
    {
        return $this->isAdmin;
    }
    public function setIsAdmin(bool $isAdmin) : void
    {
        $this->isAdmin = $isAdmin;
    }

    public function __toString()
    {
        $res = $this->getEmail();
        return $res;
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
            $this->password) = unserialize($serialized);
    }
}
