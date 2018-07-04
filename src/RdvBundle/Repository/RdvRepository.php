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

    public function getNbRDV() {
        return $this->createQueryBuilder('l')
                        ->select('COUNT(l)')
                        ->getQuery()
                        ->getSingleScalarResult();
    }

    public function getNbRDVDate() {
        return $this->createQueryBuilder('l')
                        ->select('MONTH(l.creneauxDebut) as month, COUNT(l.id) as nb')
                        ->groupBy('l.creneauxDebut')
                        ->getQuery()
                        ->getArrayResult();
    }

}
