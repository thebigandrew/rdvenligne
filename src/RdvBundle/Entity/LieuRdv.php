<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LieuRdv
 *
 * @ORM\Table(name="lieu_rdv")
 * @ORM\Entity(repositoryClass="RdvBundle\Repository\LieuRdvRepository")
 */
class LieuRdv
{
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
     * @ORM\Column(name="valide", type="boolean")
     */
    private $valide;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return LieuRdv
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return LieuRdv
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set proId
     *
     * @param \RdvBundle\Entity\User $proId
     *
     * @return LieuRdv
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
     * Set valide
     *
     * @param boolean $valide
     *
     * @return LieuRdv
     */
    public function setValide($valide)
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get valide
     *
     * @return boolean
     */
    public function getValide()
    {
        return $this->valide;
    }
}
