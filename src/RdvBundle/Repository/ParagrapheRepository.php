<?php

namespace RdvBundle\Repository;

/**
 * ParagrapheRepository
 */
class ParagrapheRepository extends \Doctrine\ORM\EntityRepository {
    
    public function findParagraphe($pro_id) {
        return $this->createQueryBuilder('p')
                        ->where('p.pro_id = :pro_id')
                        ->setParameter('pro_id', $pro_id)
                        ->orderBy('c.ville', 'ASC')
                        ->getQuery();
    }
}
