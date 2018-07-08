<?php

namespace RdvBundle\Repository;

/**
 * TypeRdvRepository
 */
class TypeRdvRepository extends \Doctrine\ORM\EntityRepository {
    
    public function getShortestTypeRdvForPro($proId) {
        return $this->createQueryBuilder('tr')
                        ->andWhere("tr.proId = :proId")
                        ->setParameter('proId', $proId)
                        ->orderBy('tr.duree', 'ASC')
                        ->setMaxResults(1)
                        ->getQuery()
                        ->getResult();
    }
}
