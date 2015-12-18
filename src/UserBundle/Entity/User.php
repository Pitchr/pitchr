<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
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
     * @var ArrayCollection $pitchs
     * @ORM\OneToMany(targetEntity="PitchBundle\Entity\Pitch", mappedBy="user", cascade={"persist", "remove"})
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
}
