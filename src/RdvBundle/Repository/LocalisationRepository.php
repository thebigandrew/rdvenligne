<?php

namespace RdvBundle\Repository;

/**
 * LocalisationRepository
 */
class LocalisationRepository extends \Doctrine\ORM\EntityRepository {

    public function findLocalisation($pro_id) {
        return $this->createQueryBuilder('l')
                        ->where('l.pro_id = :pro_id')
                        ->setParameter('pro_id', $pro_id)
                        ->orderBy('l.ordre', 'ASC')
                        ->getQuery();
    }

}
