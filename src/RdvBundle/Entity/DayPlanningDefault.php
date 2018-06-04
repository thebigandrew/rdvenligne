<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RdvDefault
 *
 * @ORM\Table(name="day_planning_default")
 * @ORM\Entity(repositoryClass="RdvBundle\Repository\DayPlanningDefaultRepository")
 */
class DayPlanningDefault
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
     * lundi = 1, dimanche = 7
     * @ORM\Column(name="jourSemaine", type="integer", nullable=true)
     */
    private $jourSemaine;

    /**
     * @ORM\ManyToOne(targetEntity="RdvBundle\Entity\PlanningDefault", inversedBy="planningDays")
     * @ORM\JoinColumn(name="planning_default_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $planningDefaultId;
    
    /**
     * @var boolean
     * @ORM\Column(name="active_day", type="boolean")
     */
    private $activeDay;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDebut", type="time", nullable=true)
     */
    private $heureDebut;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFin", type="time", nullable=true)
     */
    private $heureFin;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nbcreneaux", type="integer", nullable=true)
     */
    private $nbcreneaux;
    
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
     * Set planningDefaultId
     * @param integer $planningDefaultId
     * @return DayPlanningDefault
     */
    public function setPlanningDefaultId($planningDefaultId) {
        $this->planningDefaultId = $planningDefaultId;

        return $this;
    }

    /**
     * Get proId
     * @return int
     */
    public function getPlanningDefaultId() {
        return $this->planningDefaultId;
    }
    
    /**
     * Set planningDefaultId
     * @param integer $planningDefaultId
     * @return DayPlanningDefault
     */
    public function setActiveDay($activeDay) {
        $this->activeDay = $activeDay;

        return $this;
    }

    /**
     * Get proId
     * @return int
     */
    public function getActiveDay() {
        return $this->activeDay;
    }

    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     *
     * @return DayPlanningDefault
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
     * @return DayPlanningDefault
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
     * Set nbcreneaux
     *
     * @param integer $nbcreneaux
     *
     * @return DayPlanningDefault
     */
    public function setNbcreneaux($nbcreneaux)
    {
        $this->nbcreneaux = $nbcreneaux;

        return $this;
    }

    /**
     * Get nbcreneaux
     *
     * @return integer
     */
    public function getNbcreneaux()
    {
        return $this->nbcreneaux;
    }
}
