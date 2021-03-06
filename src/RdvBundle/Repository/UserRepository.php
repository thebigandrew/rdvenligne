<?php

namespace RdvBundle\Repository;

use Doctrine\ORM\EntityRepository as Repository;

/**
 * UserRepository
 */
class UserRepository extends Repository {

    public function validatePro($id) {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
                        'UPDATE RdvBundle\Entity\User u
            SET u.validationAdmin = true
            WHERE u.id = :id'
                )->setParameter('id', $id);
        $query->execute();
    }

    public function invalidatePro($id) {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
                        'UPDATE RdvBundle\Entity\User u
            SET u.validationAdmin = false
            WHERE u.id = :id'
                )->setParameter('id', $id);
        $query->execute();
    }

    public function getNbUser($roles) {
        return $this->createQueryBuilder('l')
                        ->select('COUNT(l)')
                        ->andWhere("l.roles like :roles")
                        ->setParameter('roles', "%" . $roles . "%")
                        ->getQuery()
                        ->getSingleScalarResult();
    }

    public function getNbMetierUser() {
        return $this->createQueryBuilder('l')
                        ->select('l.metier, COUNT(l.id) as nb')
                        ->groupBy('l.metier')
                        ->andWhere("l.roles like :roles")
                        ->setParameter('roles', "%PRO%")
                        ->getQuery()
                        ->getArrayResult();
    }
    
    public function getProsByNom($str){
        return $this->createQueryBuilder('u')
                    ->select('u')
                    ->andWhere("CONCAT(u.firstname, ' ', u.lastname) like :str")
                    ->setParameter('str', "%$str%")
                    ->getQuery()
                    ->getResult();
    }
}
