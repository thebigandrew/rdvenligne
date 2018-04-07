<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localisation
 *
 * @ORM\Table(name="Localisation")
 * @ORM\Entity(repositoryClass="RdvBundle\Repository\LocalisationRepository")
 */
class Localisation {

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     * @ORM\Column(name="codePostal", type="string", length=5)
     */
    private $codePostal;

    /**
     * @var string
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity="RdvBundle\Entity\user")
     * @ORM\JoinColumn(name="pro_id", referencedColumnName="id")
     */
    private $proId;

    /**
     * Get id
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set adresse
     * @param string $adresse
     * @return Localisation
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     * @return string
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * Set codePostal
     * @param string $codePostal
     * @return Localisation
     */
    public function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;
        return $this;
    }

    /**
     * Get codePostal
     * @return string
     */
    public function getCodePostal() {
        return $this->codePostal;
    }

    /**
     * Set ville
     * @param string $ville
     * @return Localisation
     */
    public function setVille($ville) {
        $this->ville = $ville;
        return $this;
    }

    /**
     * Get ville
     * @return string
     */
    public function getVille() {
        return $this->ville;
    }

    /**
     * Set proId
     * @param integer $proId
     * @return Localisation
     */
    public function setUserId($proId) {
        $this->proId = $proId;
        return $this;
    }

    /**
     * Get proId
     * @return int
     */
    public function getProId() {
        return $this->proId;
    }

}
