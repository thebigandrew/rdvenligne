<?php
namespace RdvBundle\Repository;
use Doctrine\ORM\EntityRepository as Repository;
/**
 * UserRepository
 */
class UserRepository extends Repository {
    public function validatePro($id)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'UPDATE RdvBundle\Entity\User u
            SET u.validationAdmin = true
            WHERE u.id = :id'
        )->setParameter('id', $id);
        $query->execute();
    }
    
    public function invalidatePro($id)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'UPDATE RdvBundle\Entity\User u
            SET u.validationAdmin = false
            WHERE u.id = :id'
        )->setParameter('id', $id);
        $query->execute();
    }
}