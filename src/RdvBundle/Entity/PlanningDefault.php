<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RdvDefault
 *
 * @ORM\Table(name="planning_default")
 * @ORM\Entity(repositoryClass="RdvBundle\Repository\PlanningDefaultRepository")
 */
class PlanningDefault
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
     * @ORM\OneToOne(targetEntity="RdvBundle\Entity\User")
     * @ORM\JoinColumn(name="pro_id", referencedColumnName="id", nullable=false)
     */
    private $proId;
    
    /**
     * @ORM\OneToMany(targetEntity="RdvBundle\Entity\DayPlanningDefault", mappedBy="planningDefaultId", cascade={"persist", "remove"})
     */
    private $planningDays;
    
    public function __construct__()
    {
        $this->planningDays = new ArrayCollection();
    }
    
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
     * Set proId
     * @param integer $proId
     * @return Rdv
     */
    public function setProId($proId) {
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
    
    public function getPlanningDays()
    {
        return $this->planningDays;
    }
    
    public function addPlanningDay($planningDay)
    {
        $this->planningDays[] = $planningDay;
        $planningDay->setPlanningDefaultId( $this );
        return $this;
    }
    
    public function setPlanningDays($planningDays)
    {
       $this->planningDays = $planningDays;
       
       for($i = 0; $i < count($this->planningDays); $i++)
       {
           $this->planningDays[$i]->setPlanningDefaultId($this);
       }
    }
}
