<?php

namespace TesBoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="TesBoBundle\Repository\UsersRepository")
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=255, unique=true)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registered_datetime", type="datetimetz")
     */
    private $registeredDatetime;

    /**
     * @var bool
     *
     * @ORM\Column(name="isBanned", type="boolean")
     */
    private $isBanned;

    /**
     * @var string
     *
     * @ORM\Column(name="ban_motif", type="string", length=255)
     */
    private $banMotif;

    /**
     * @var string
     *
     * @ORM\Column(name="ban_until", type="string", length=255)
     */
    private $banUntil;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Users
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    
        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set registeredDatetime
     *
     * @param \DateTime $registeredDatetime
     *
     * @return Users
     */
    public function setRegisteredDatetime($registeredDatetime)
    {
        $this->registeredDatetime = $registeredDatetime;
    
        return $this;
    }

    /**
     * Get registeredDatetime
     *
     * @return \DateTime
     */
    public function getRegisteredDatetime()
    {
        return $this->registeredDatetime;
    }

    /**
     * Set isBanned
     *
     * @param boolean $isBanned
     *
     * @return Users
     */
    public function setIsBanned($isBanned)
    {
        $this->isBanned = $isBanned;
    
        return $this;
    }

    /**
     * Get isBanned
     *
     * @return boolean
     */
    public function getIsBanned()
    {
        return $this->isBanned;
    }

    /**
     * Set banMotif
     *
     * @param string $banMotif
     *
     * @return Users
     */
    public function setBanMotif($banMotif)
    {
        $this->banMotif = $banMotif;
    
        return $this;
    }

    /**
     * Get banMotif
     *
     * @return string
     */
    public function getBanMotif()
    {
        return $this->banMotif;
    }

    /**
     * Set banUntil
     *
     * @param string $banUntil
     *
     * @return Users
     */
    public function setBanUntil($banUntil)
    {
        $this->banUntil = $banUntil;
    
        return $this;
    }

    /**
     * Get banUntil
     *
     * @return string
     */
    public function getBanUntil()
    {
        return $this->banUntil;
    }
}

