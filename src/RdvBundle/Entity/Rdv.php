<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rdv
 * @ORM\Table(name="rdv")
 * @ORM\Entity(repositoryClass="RdvBundle\Repository\RdvRepository")
 */
class Rdv {
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(name="creneauxDebut", type="datetime")
     */
    private $creneauxDebut;

    /**
     * @var \DateTime
     * @ORM\Column(name="creneauxFin", type="datetime")
     */
    private $creneauxFin;

    /**
     * @var bool
     * @ORM\Column(name="validation", type="boolean")
     */
    private $validation;

    /**
     * @var bool
     * @ORM\Column(name="statut", type="boolean")
     */
    private $statut;

    
    /**
     * @ORM\ManyToOne(targetEntity="RdvBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;
    
    /**
     * @ORM\ManyToOne(targetEntity="RdvBundle\Entity\User")
     * @ORM\JoinColumn(name="pro_id", referencedColumnName="id")
     */
    private $proId;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="RdvBundle\Entity\TypeRdv")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $typeId;
    
    
    /**
     * Get id
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set creneauxDebut
     * @param \DateTime $creneauxDebut
     * @return Rdv
     */
    public function setCreneauxDebut($creneauxDebut) {
        $this->creneauxDebut = $creneauxDebut;
        return $this;
    }

    /**
     * Get creneauxDebut
     * @return \DateTime
     */
    public function getCreneauxDebut() {
        return $this->creneauxDebut;
    }

    /**
     * Set creneauxFin
     * @param \DateTime $creneauxFin
     * @return Rdv
     */
    public function setCreneauxFin($creneauxFin) {
        $this->creneauxFin = $creneauxFin;
        return $this;
    }

    /**
     * Get creneauxFin
     * @return \DateTime
     */
    public function getCreneauxFin() {
        return $this->creneauxFin;
    }

    /**
     * Set validation
     * @param boolean $validation
     * @return Rdv
     */
    public function setValidation($validation) {
        $this->validation = $validation;
        return $this;
    }

    /**
     * Get validation
     * @return bool
     */
    public function getValidation() {
        return $this->validation;
    }

    /**
     * Set statut
     * @param boolean $statut
     * @return Rdv
     */
    public function setStatut($statut) {
        $this->statut = $statut;
        return $this;
    }

    /**
     * Get statut
     * @return bool
     */
    public function getStatut() {
        return $this->statut;
    }

    /**
     * Set userId
     * @param integer $userId
     * @return Rdv
     */
    public function setUserId($userId) {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Set proId
     * @param integer $proId
     * @return Rdv
     */
    public function setProId($proId) {
        $this->userId = $proId;

        return $this;
    }

    /**
     * Get proId
     * @return int
     */
    public function getProId() {
        return $this->proId;
    }

    /**
     * Set typeId
     * @param integer $typeId
     * @return Rdv
     */
    public function setTypeId($typeId) {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     * @return int
     */
    public function getTypeId() {
        return $this->typeId;
    }
}
