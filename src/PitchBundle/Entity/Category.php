<?php

namespace PitchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="PitchBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @var ArrayCollection $pitchs
     * @ORM\OneToMany(targetEntity="PitchBundle\Entity\Pitch", mappedBy="category", cascade={"persist", "remove"}))
     * @ORM\JoinColumn(nullable=true)
     */
    private $pitchs;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Category
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
     * To String
     * @return string
     */
    public function toString(){
        return $this->title;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pitchs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pitch
     *
     * @param \PitchBundle\Entity\Pitch $pitch
     *
     * @return Category
     */
    public function addPitch(\PitchBundle\Entity\Pitch $pitch)
    {
        $this->pitchs[] = $pitch;

        return $this;
    }

    /**
     * Remove pitch
     *
     * @param \PitchBundle\Entity\Pitch $pitch
     */
    public function removePitch(\PitchBundle\Entity\Pitch $pitch)
    {
        $this->pitchs->removeElement($pitch);
    }

    /**
     * Get pitchs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPitchs()
    {
        return $this->pitchs;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
