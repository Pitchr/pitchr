<?php

namespace PitchBundle\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use PitchBundle\Entity\Pitch;
use UserBundle\Entity\User;

/**
 * PitchRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PitchRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param User $user
     * @param Pitch $pitch
     * @return array
     */
    public function findMorePitchs(User $user, Pitch $pitch)
    {
        $qb = $this->createQueryBuilder('p');

        $qb->where('p.user = :user')
            ->andWhere('p != :pitch')
            ->setParameter('user', $user)
            ->setParameter('pitch', $pitch)
            ->orderBy('p.createdAt', 'desc')
            ->setMaxResults(4);

        return $qb->getQuery()->getResult();
    }

    /**
     * Pagination
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findLastPitchs(){

        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.createdAt','desc');

        return $qb;
    }

    /**
     * Pagination
     *
     * @param User $user
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findLastPitchsByUser(User $user){

        $qb = $this->createQueryBuilder('p')
            ->where('p.user = :user')
            ->setParameter('user', $user)
            ->orderBy('p.createdAt','desc');

        return $qb;
    }
}
