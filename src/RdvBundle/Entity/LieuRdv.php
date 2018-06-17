<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LieuRdv
 *
 * @ORM\Table(name="lieu_rdv")
 * @ORM\Entity(repositoryClass="RdvBundle\Repository\LieuRdvRepository")
 */
class LieuRdv {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="RdvBundle\Entity\User")
     * @ORM\JoinColumn(name="pro_id", referencedColumnName="id")
     */
    private $proId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    private $enable;

    /**
     * @ORM\ManyToMany(targetEntity="RdvBundle\Entity\TypeRdv")
     * @ORM\JoinColumn(name="typeRdv", referencedColumnName="id")
     */
    private $typeRdv;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return LieuRdv
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return LieuRdv
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Set proId
     *
     * @param \RdvBundle\Entity\User $proId
     *
     * @return LieuRdv
     */
    public function setProId(\RdvBundle\Entity\User $proId = null) {
        $this->proId = $proId;

        return $this;
    }

    /**
     * Get proId
     *
     * @return \RdvBundle\Entity\User
     */
    public function getProId() {
        return $this->proId;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     *
     * @return LieuRdv
     */
    public function setEnable($enable) {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean
     */
    public function getEnable() {
        return $this->enable;
    }

    /**
     * Set typeRdv
     *
     * @param integer $typeRdv
     *
     * @return LieuRdv
     */
    public function setTypeRdv($typeRdv) {
        $this->typeRdv = $typeRdv;

        return $this;
    }

    /**
     * Get typeRdv
     *
     * @return typeRdv
     */
    public function getTypeRdv() {
        return $this->typeRdv;
    }

    public function removeTypeRdv(TypeRdv $typeRdv) {
        $this->typeRdv->removeElement($typeRdv);
    }

}
