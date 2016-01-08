<?php

namespace PitchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use PitchBundle\Model\SafeObjectInterface;
use JMS\Serializer\Annotation\Groups;

/**
 * Pitch
 *
 * @ORM\Table(name="pitch")
 * @ORM\Entity(repositoryClass="PitchBundle\Repository\PitchRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Pitch implements SafeObjectInterface
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
     * @Groups({"post","put"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     * @Groups({"post","put"})
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     * @Groups({"post","put"})
     */
    private $description;

    /**
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @var int
     *
     * @ORM\Column(name="views", type="integer")
     */
    private $views;

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
     * @ORM\ManyToOne(targetEntity="PitchBundle\Entity\Category", inversedBy="pitches", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"post","put"})
     */
    private $category;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="pitches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \Datetime();
        $this->views = 0;
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

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Pitch
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Pre-persist slug
     *
     * @ORM\PrePersist
     */
    public function updateSlug()
    {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $this->url, $match)) {
            $this->url = $match[1];
        }
    }

    /**
     * Set views
     *
     * @param integer $views
     *
     * @return Pitch
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return integer
     */
    public function getViews()
    {
        return $this->views;
    }


    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Pitch
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Returns a safe object of this entity
     * @return object safeObject
     */
    public function getSafeObject()
    {
        return array("title" => $this->getTitle(),
            "description" => $this->getDescription(),
            "slug" => $this->getSlug(),
            "views" => $this->getViews(),
            "created_at" => $this->getCreatedAt(),
            "updated_at" => $this->getUpdatedAt(),
            "category" => $this->getCategory()->getSlug(),
            "user" => $this->getUser()->getUsernameCanonical());
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
}
