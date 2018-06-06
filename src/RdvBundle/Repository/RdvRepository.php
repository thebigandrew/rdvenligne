<?php

namespace RdvBundle\Repository;

/**
 * RdvRepository
 */
class RdvRepository extends \Doctrine\ORM\EntityRepository {

    public function getNb($idPro) {
        return $this->createQueryBuilder('l')
                        ->select('COUNT(l)')
                        ->andWhere("l.proId = :idPro")
                        ->setParameter('idPro', $idPro)
                        ->distinct('userId')
                        ->getQuery()
                        ->getSingleScalarResult();
    }

}
