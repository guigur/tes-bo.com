<?php

namespace TesBoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes")
 * @ORM\Entity(repositoryClass="TesBoBundle\Repository\LikesRepository")
 */
class Likes
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
     * @ORM\OneToOne(targetEntity="TesBoBundle\Entity\Medias", cascade={"persist"})
     */
    private $media;

    /**
     * @var int
     *
     * @ORM\OneToOne(targetEntity="TesBoBundle\Entity\Users", cascade={"persist"})
     */
    private $user;

    /**
     * @var bool
     *
     * @ORM\Column(name="isBo", type="boolean")
     */
    private $isBo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="liked_datetime", type="datetimetz")
     */
    private $likedDatetime;


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
     * Set media
     *
     * @param integer $media
     *
     * @return Likes
     */
    public function setMedia($media)
    {
        $this->media = $media;
    
        return $this;
    }

    /**
     * Get media
     *
     * @return integer
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return Likes
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
     * Set isBo
     *
     * @param boolean $isBo
     *
     * @return Likes
     */
    public function setIsBo($isBo)
    {
        $this->isBo = $isBo;
    
        return $this;
    }

    /**
     * Get isBo
     *
     * @return boolean
     */
    public function getIsBo()
    {
        return $this->isBo;
    }

    /**
     * Set likedDatetime
     *
     * @param \DateTime $likedDatetime
     *
     * @return Likes
     */
    public function setLikedDatetime($likedDatetime)
    {
        $this->likedDatetime = $likedDatetime;
    
        return $this;
    }

    /**
     * Get likedDatetime
     *
     * @return \DateTime
     */
    public function getLikedDatetime()
    {
        return $this->likedDatetime;
    }
}

