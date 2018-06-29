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

    public function getRdvBetweenDates($oDateDeb, $oDateFin, $oUser){
        $qb = $this->createQueryBuilder('r')
                   ->select('r')
                   ->andWhere('r.creneauxDebut > :oDateDeb')
                   ->andWhere('r.creneauxFin < :oDateFin')
                   ->andWhere('r.proId = :user')
                   ->setParameter('oDateDeb', $oDateDeb)
                   ->setParameter('oDateFin', $oDateFin)
                   ->setParameter('user', $oUser)
                   ->getQuery()
                   ->getResult();
        return $qb;
    }
}
