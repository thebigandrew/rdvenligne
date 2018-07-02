<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Rdv
 * @ORM\Table(name="rdv")
 * @ORM\Entity(repositoryClass="RdvBundle\Repository\RdvRepository")
 */
class Rdv implements \JsonSerializable {
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
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
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
     * @ORM\ManyToOne(targetEntity="RdvBundle\Entity\LieuRdv")
     * @ORM\JoinColumn(name="lieu_id", referencedColumnName="id")
     */
    private $lieu;
    
    /**
     * @var string
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;
    
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Rdv
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set userId
     *
     * @param \RdvBundle\Entity\User $userId
     *
     * @return Rdv
     */
    public function setUserId(\RdvBundle\Entity\User $userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \RdvBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set proId
     *
     * @param \RdvBundle\Entity\User $proId
     *
     * @return Rdv
     */
    public function setProId(\RdvBundle\Entity\User $proId = null)
    {
        $this->proId = $proId;

        return $this;
    }

    /**
     * Get proId
     *
     * @return \RdvBundle\Entity\User
     */
    public function getProId()
    {
        return $this->proId;
    }

    /**
     * Set typeId
     *
     * @param \RdvBundle\Entity\TypeRdv $typeId
     *
     * @return Rdv
     */
    public function setTypeId(\RdvBundle\Entity\TypeRdv $typeId = null)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return \RdvBundle\Entity\TypeRdv
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set lieu
     *
     * @param \RdvBundle\Entity\LieuRdv $lieu
     *
     * @return Rdv
     */
    public function setLieu(\RdvBundle\Entity\LieuRdv $lieu = null)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return \RdvBundle\Entity\LieuRdv
     */
    public function getLieu()
    {
        return $this->lieu;
    }
    
    public function getDescription()
    {
        if( $this->userId === null){
            return $this->commentaire;
        } else {
            return $this->userId->getFirstName() . ' ' . $this->userId->getLastName() . ' ' . $this->userId->getTelephone();
        }
    }
    
        public function jsonSerialize()
    {
        return [
            'title' => $this->getDescription(),
            'start' => $this->creneauxDebut->format('Y-m-d H:i:s'),
            'end' => $this->creneauxFin->format('Y-m-d H:i:s')
        ];
    }
}
