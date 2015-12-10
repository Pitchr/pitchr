<?php

namespace PitchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pitch
 *
 * @ORM\Table(name="pitch")
 * @ORM\Entity(repositoryClass="PitchBundle\Repository\PitchRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Pitch
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
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var ArrayCollection $comments
     * @ORM\OneToMany(targetEntity="PitchBundle\Entity\Comment", mappedBy="pitch", cascade={"persist", "remove"}))
     * @ORM\JoinColumn(nullable=true)
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="PitchBundle\Entity\Category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \Datetime();
    }

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
     * @return Pitch
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
     * @return Pitch
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
     * Set url
     *
     * @param string $url
     *
     * @return Pitch
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Pitch
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Pitch
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Update date
     *
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->setUpdatedAt(new \Datetime());
    }

    /**
     * Add comment
     *
     * @param \PitchBundle\Entity\Comment $comment
     *
     * @return Pitch
     */
    public function addComment(\PitchBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }


    /**
     * Set comments
     *
     * @param \PitchBundle\Entity\Comment $comments
     *
     * @return Pitch
     */
    public function setComments(\PitchBundle\Entity\Comment $comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return \PitchBundle\Entity\Comment
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Remove comment
     *
     * @param \PitchBundle\Entity\Comment $comment
     */
    public function removeComment(\PitchBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Set category
     *
     * @param \PitchBundle\Entity\Category $category
     *
     * @return Pitch
     */
    public function setCategory(\PitchBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \PitchBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
