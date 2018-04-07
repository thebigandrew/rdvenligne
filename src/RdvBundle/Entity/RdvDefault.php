<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RdvDefault
 *
 * @ORM\Table(name="rdv_default")
 * @ORM\Entity(repositoryClass="RdvBundle\Repository\RdvDefaultRepository")
 */
class RdvDefault
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
     * @var int
     *
     * @ORM\Column(name="jourSemaine", type="integer")
     */
    private $jourSemaine;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDebut", type="time")
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFin", type="time")
     */
    private $heureFin;

    /**
     * @var int
     *
     * @ORM\Column(name="nbCreneaux", type="integer")
     */
    private $nbCreneaux;


    /**
     * @ORM\ManyToOne(targetEntity="RdvBundle\Entity\user")
     * @ORM\JoinColumn(name="pro_id", referencedColumnName="id")
     */
    private $proId;
    
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
     * Set jourSemaine
     *
     * @param integer $jourSemaine
     *
     * @return RdvDefault
     */
    public function setJourSemaine($jourSemaine)
    {
        $this->jourSemaine = $jourSemaine;

        return $this;
    }

    /**
     * Get jourSemaine
     *
     * @return int
     */
    public function getJourSemaine()
    {
        return $this->jourSemaine;
    }

    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     *
     * @return RdvDefault
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     *
     * @return RdvDefault
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set nbCreneaux
     *
     * @param integer $nbCreneaux
     *
     * @return RdvDefault
     */
    public function setNbCreneaux($nbCreneaux)
    {
        $this->nbCreneaux = $nbCreneaux;

        return $this;
    }

    /**
     * Get nbCreneaux
     *
     * @return int
     */
    public function getNbCreneaux()
    {
        return $this->nbCreneaux;
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
}

