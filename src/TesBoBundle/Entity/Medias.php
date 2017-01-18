<?php

namespace TesBoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medias
 *
 * @ORM\Table(name="medias")
 * @ORM\Entity(repositoryClass="TesBoBundle\Repository\MediasRepository")
 */
class Medias
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
     * @ORM\OneToOne(targetEntity="TesBoBundle\Entity\Galeries", cascade={"persist"})
     */
    private $galerie;

    /**
     * @var int
     *
     * @ORM\OneToOne(targetEntity="TesBoBundle\Entity\Users", cascade={"persist"})
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="media", type="blob")
     */
    private $media;

    /**
     * @var bool
     *
     * @ORM\Column(name="isVisible", type="boolean")
     */
    private $isVisible;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime_posted", type="datetimetz")
     */
    private $datetimePosted;


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
     * Set galerie
     *
     * @param integer $galerie
     *
     * @return Medias
     */
    public function setGalerie($galerie)
    {
        $this->galerie = $galerie;
    
        return $this;
    }

    /**
     * Get galerie
     *
     * @return integer
     */
    public function getGalerie()
    {
        return $this->galerie;
    }

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return Medias
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
     * Set title
     *
     * @param string $title
     *
     * @return Medias
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Medias
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set media
     *
     * @param string $media
     *
     * @return Medias
     */
    public function setMedia($media)
    {
        $this->media = $media;
    
        return $this;
    }

    /**
     * Get media
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set isVisible
     *
     * @param boolean $isVisible
     *
     * @return Medias
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;
    
        return $this;
    }

    /**
     * Get isVisible
     *
     * @return boolean
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * Set datetimePosted
     *
     * @param \DateTime $datetimePosted
     *
     * @return Medias
     */
    public function setDatetimePosted($datetimePosted)
    {
        $this->datetimePosted = $datetimePosted;
    
        return $this;
    }

    /**
     * Get datetimePosted
     *
     * @return \DateTime
     */
    public function getDatetimePosted()
    {
        return $this->datetimePosted;
    }
}

