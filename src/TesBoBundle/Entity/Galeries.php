<?php

namespace TesBoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Galeries
 *
 * @ORM\Table(name="galeries")
 * @ORM\Entity(repositoryClass="TesBoBundle\Repository\GalleriesRepository")
 */
class Galeries
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
     * @var int
     *
     * @ORM\OneToOne(targetEntity="TesBoBundle\Entity\Users", cascade={"persist"})
     */
    private $user;

    /**
     * @var bool
     *
     * @ORM\Column(name="isEnable", type="boolean")
     */
    private $isEnable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime_Created", type="datetimetz")
     */
    private $datetimeCreated;


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
     * Set user
     *
     * @param integer $user
     *
     * @return Galleries
     */
    public function setUser($user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set isEnable
     *
     * @param boolean $isEnable
     *
     * @return Galleries
     */
    public function setIsEnable($isEnable)
    {
        $this->isEnable = $isEnable;
    
        return $this;
    }

    /**
     * Get isEnable
     *
     * @return boolean
     */
    public function getIsEnable()
    {
        return $this->isEnable;
    }

    /**
     * Set datetimeCreated
     *
     * @param \DateTime $datetimeCreated
     *
     * @return Galleries
     */
    public function setDatetimeCreated($datetimeCreated)
    {
        $this->datetimeCreated = $datetimeCreated;
    
        return $this;
    }

    /**
     * Get datetimeCreated
     *
     * @return \DateTime
     */
    public function getDatetimeCreated()
    {
        return $this->datetimeCreated;
    }
}

