<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Time;

/**
 * TypeRdv
 * @ORM\Table(name="type_rdv")
 * @ORM\Entity(repositoryClass="RdvBundle\Repository\TypeRdvRepository")
 */
class TypeRdv {

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
    
    /**
     * @var float
     * @ORM\Column(name="tarif", type="float")
     */
    private $tarif;
    
    /**
     * @var Time
     * @ORM\Column(name="duree", type="time")
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity="RdvBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * Get id
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set type
     * @param string $type
     * @return TypeRdv
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set userId
     * @param integer $userId
     * @return TypeRdv
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
     * Set tarif
     *
     * @param float $tarif
     *
     * @return TypeRdv
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return float
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set duree
     *
     * @param \DateTime $duree
     *
     * @return TypeRdv
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return \DateTime
     */
    public function getDuree()
    {
        return $this->duree;
    }
}
