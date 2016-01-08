<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true, length=500)
     * @Groups({"post","put"})
     */
    protected $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=false)
     * @Groups({"post","put"})
     */
    private $name;

    /**
     * @var ArrayCollection $pitches
     * @ORM\OneToMany(targetEntity="PitchBundle\Entity\Pitch", mappedBy="user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $pitches;

    /**
     * @var ArrayCollection $comments
     * @ORM\OneToMany(targetEntity="PitchBundle\Entity\Comment", mappedBy="user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $comments;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    protected $email;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
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
     * Add pitch
     *
     * @param \PitchBundle\Entity\Pitch $pitch
     *
     * @return User
     */
    public function addPitch(\PitchBundle\Entity\Pitch $pitch)
    {
        $this->pitches[] = $pitch;

        return $this;
    }

    /**
     * Remove pitch
     *
     * @param \PitchBundle\Entity\Pitch $pitch
     */
    public function removePitch(\PitchBundle\Entity\Pitch $pitch)
    {
        $this->pitches->removeElement($pitch);
    }

    /**
     * Get pitches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPitches()
    {
        return $this->pitches;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
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
     * Set description
     *
     * @param string $description
     *
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Add comment
     *
     * @param \PitchBundle\Entity\Comment $comment
     *
     * @return User
     */
    public function addComment(\PitchBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
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
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
    * Returns a safe object of this entity
    * @return object safeObject
    */
    public function getSafeObject() {
        return array("username_canonical" => $this->getUsernameCanonical(),
        "username" => $this->getUsername(),
        "email" => $this->getEmail(),
        "description" => $this->getDescription(),
        "created_at" => $this->getCreatedAt());
    }
}
