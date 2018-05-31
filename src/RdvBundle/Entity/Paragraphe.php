<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paragraphe
 *
 * @ORM\Table(name="paragraphe")
 * @ORM\Entity(repositoryClass="RdvBundle\Repository\ParagrapheRepository")
 */
class Paragraphe {

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="titre", type="text")
     */
    private $titre;

    /**
     * @var string
     * @ORM\Column(name="text", type="text")
     */
    private $text;

       /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="RdvBundle\Entity\user")
     * @ORM\JoinColumn(name="professionnel_id", referencedColumnName="id")
     */
    private $professionnelId;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModification", type="datetime")
     */
    private $dateModification;
    /**
     * Get id
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set titre
     * @param string $titre
     * @return Professionnel_Localisation
     */
    public function setTitre($titre) {
        $this->titre = $titre;
        return $this;
    }

    /**
     * Get titre
     * @return string
     */
    public function getTitre() {
        return $this->titre;
    }

    /**
     * Set text
     * @param string $text
     * @return Paragraphe
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    /**
     * Get text
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * Set professionnelId
     *
     * @param integer professionnelId
     *
     * @return Paragraphe
     */
    public function setProfessionnelId($professionnelId)
    {
        $this->professionnelId = $professionnelId;

        return $this;
    }

    /**
     * Get professionnelId
     *
     * @return int
     */
    public function getProfessionnelId()
    {
        return $this->professionnelId;
    }
    
    
    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Paragraphe
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateModification
     *
     * @param \DateTime $dateModification
     *
     * @return Paragraphe
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * Get dateModification
     *
     * @return \DateTime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }
}
