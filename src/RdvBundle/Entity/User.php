<?php

namespace RdvBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="RdvBundle\Repository\UserRepository")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="text")
     */
    private $lastname;

    /**
     * @var string
     * @ORM\Column(name="firstname", type="text")
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column(name="telephone", type="text")
     */
    private $telephone;
    
    /**
     * @var dateNaissance
     * @ORM\Column(name="dateNaissance", type="date")
     */
    private $dateNaissance;
    
    /**
     * @var boolean
     * @ORM\Column(name="validationAdmin", type="boolean")
     */
    private $validationAdmin;

    public function __construct() {
        parent::__construct();
        
        // Set to false by default
        $this->validationAdmin = false;
        
        // Ajouté pour les tests de droits
        $this->addRole('ROLE_ADMIN');
    }

    /**
     * Set lastname
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Get lastname
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set lastname
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get firstname
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }
    
    /**
     * Set telephone
     * @param string $telephone
     * @return User
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * Get telephone
     * @return string
     */
    public function getTelephone() {
        return $this->telephone;
    }
    
    /**
     * Set dateNaissance
     * @param date $dateNaissance
     * @return User
     */
    public function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }
    
    /**
     * Get dateNaissance
     * @return boolean
     */
    public function getDateNaissance() {
        return $this->dateNaissance;
    }

    /**
     * Get validationAdmin
     * @return boolean
     */
    public function getValidationAdmin() {
        return $this->validationAdmin;
    }

    /**
     * Set validationAdmin
     * @param boolean $validationAdmin
     * @return User
     */
    public function setValidationAdmin($validationAdmin) {
        $this->validationAdmin = $validationAdmin;
        return $this;
    }
}
