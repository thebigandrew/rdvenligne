<?php

namespace RdvBundle\Repository;

/**
 * RdvRepository
 */
class RdvRepository extends \Doctrine\ORM\EntityRepository {

    public function getNb($idPro) {
        return $this->createQueryBuilder('l')
                        ->select('COUNT(distinct l.userId)')
                        ->where("l.proId = :idPro")
                        ->setParameter('idPro', $idPro)
                        ->getQuery()
                        ->getSingleScalarResult();
    }

}
