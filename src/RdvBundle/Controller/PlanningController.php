<?php

namespace RdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use RdvBundle\Form\PlanningDefaultType;
use RdvBundle\Entity\PlanningDefault;
use RdvBundle\Entity\DayPlanningDefault;

class PlanningController extends Controller
{
    
    public function createDefaultAction(Request $request){
        if ($request->isMethod('post')) {
            $planningDefault = new PlanningDefault();
            $planningDefault->setProId($this->getUser());
            $form = $form = $this->createForm(PlanningDefaultType::class, $planningDefault);
            $form->handleRequest($request);
            if ($form->isSubmitted() and $form->isValid()) {
                $entityManager->persist($planningDefault);
                $entityManager->flush();
                return $this->redirectToRoute('rdv_homepage');
            }
        }
        
        $planningDefault = new PlanningDefault();
        
        // Ajouter les jours de la semaine.
        for($i = 1; $i < 8; $i++)
        {
            $planningDay = new DayPlanningDefault();
            $planningDay->setActiveDay(true);
            $planningDay->setJourSemaine($i);
            
            $planningDefault->addPlanningDay( $planningDay );
        }
        
        $form = $form = $this->createForm(PlanningDefaultType::class, $planningDefault);
        return $this->render('RdvBundle:Planning:create_default.html.twig', array('form' => $form->createView()));

        
    }

}
