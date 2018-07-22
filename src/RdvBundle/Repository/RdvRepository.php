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
    
    public function countOverlappingRdv($proId, $start, $end)
    {
        // Si rdv commence sur le créneaux, fini sur le crénaux ou l'englobe.
        $whereClause = <<<EOT
r.proId = :proId AND (
    (r.creneauxDebut >= :start AND r.creneauxDebut <= :end) OR
    (r.creneauxFin >= :start AND r.creneauxFin <= :end) OR
    (r.creneauxDebut < :start AND r.creneauxFin > :end)
)
EOT;
        $qb = $this->createQueryBuilder('r')
                   ->select('count(r)')
                   ->where($whereClause)
                   ->setParameter('start', $start)
                   ->setParameter('end', $end)
                   ->setParameter('proId', $proId)
                   ->getQuery()
                   ->getSingleScalarResult();
        return $qb;
    }
    
    public function getRdvARapeller()
    {
        $tomorrow = new \DateTime('tomorrow');
        
        $qb = $this->createQueryBuilder('r')
                   ->select('r')
                   ->andWhere('r.creneauxDebut <= :tomorrow')
                   ->andWhere('(r.rappel = false OR r.rappel IS NULL)')
                   ->setParameter('tomorrow', $tomorrow)
                   ->getQuery()
                   ->getResult();
        
        return $qb;
    }
    
    public function rappellerRdv($id)
    {
        $qb = $this->createQueryBuilder('r');
        $qb->update()
            ->set('r.rappel', true)
            ->where('r.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
    }
}
