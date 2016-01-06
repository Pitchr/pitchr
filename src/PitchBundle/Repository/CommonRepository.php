<?php

namespace PitchBundle\Repository;


class CommonRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * Filters the objects according to limit, offset and sorts
     * @param array $query array("limit" => 10, "offset" => 0, "sort" => "-created_at")
     * @return array of results
     */
    public function filterObjectsByQuery(array $query, $fieldName)
    {
        //todo: verfier si 1 column est recuperer
        $qb = $this->createQueryBuilder('o')->select('o.' . $fieldName);
        if (!empty($query['sort'])) {
            if (!substr_compare($query['sort'], '-', 0, 1)) {
                $cutoff = substr($query['sort'], 1);
                if (in_array($cutoff, $this->getClassMetadata()->getFieldNames()))
                    $qb->addOrderBy('o.' . substr($query['sort'], 1), 'DESC');
            } else {
                if (in_array($query['sort'], $this->getClassMetadata()->getFieldNames()))
                    $qb->addOrderBy('o.' . $query['sort'], 'ASC');
            }
        }
        if (isset($query['limit'])) {
            $qb->setMaxResults($query['limit']);
        }
        if (isset($query['offset'])) {
            $qb->setFirstResult($query['offset']);
        }

        return array_map(function ($item) use ($fieldName) {
            return $item[$fieldName];
        }, $qb->getQuery()->getResult());
    }
}