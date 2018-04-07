<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Professionnel_Localisation
 *
 * @ORM\Table(name="Paragraphe")
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
     * @var integer
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;

    /**
     * @ORM\ManyToOne(targetEntity="RdvBundle\Entity\user")
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
     * Set ordre
     * @param string $ordre
     * @return Paragraphe
     */
    public function setOrdre($ordre) {
        $this->ordre = $ordre;
        return $this;
    }

    /**
     * Get ordre
     * @return string
     */
    public function getOrdre() {
        return $this->ordre;
    }

    /**
     * Set userId
     * @param integer $userId
     * @return Paragraphe
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

}
