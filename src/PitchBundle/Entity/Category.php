<?php

namespace PitchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var ArrayCollection $pitchs
     * @ORM\ManyToOne(targetEntity="PitchBundle\Entity\Pitch"))
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
     * Add pitch
     *
     * @param \PitchBundle\Entity\Pitch $pitch
     *
     * @return Pitch
     */
    public function addPitch(\PitchBundle\Entity\Pitch $pitch)
    {
        $this->pitchs[] = $pitch;

        return $this;
    }

    /**
     * Set pitchs
     *
     * @param \PitchBundle\Entity\Pitch $pitchs
     *
     * @return Pitch
     */
    public function setPitchs(\PitchBundle\Entity\Pitch $pitchs)
    {
        $this->pitchs = $pitchs;

        return $this;
    }

    /**
     * Get pitchs
     *
     * @return \PitchBundle\Entity\Pitch
     */
    public function getPitchs()
    {
        return $this->pitchs;
    }
}
