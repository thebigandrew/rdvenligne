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
     * @ORM\Column(name="jourSemaine", type="integer")
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
}

