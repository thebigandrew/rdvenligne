<?php
namespace RdvBundle\Repository;
use Doctrine\ORM\EntityRepository as Repository;

/**
 * UserRepository
 */
class UserRepository extends Repository {
    public function validateUser($id)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'UPDATE RdvBundle\Entity\User u
            SET u.validationAdmin = true
            WHERE u.id = :id'
        )->setParameter('id', $id);
        $query->execute();
    }
}