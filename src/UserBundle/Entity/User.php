<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

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
     * @ORM\Column(name="description", type="text", nullable=false, length=500)
     */
    protected $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var ArrayCollection $pitchs
     * @ORM\OneToMany(targetEntity="PitchBundle\Entity\Pitch", mappedBy="user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $pitchs;

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
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
