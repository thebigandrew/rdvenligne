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
        $entityManager = $this->getDoctrine()->getManager();
        $oUser = $this->getUser();
        $rPlanningDefault = $entityManager->getRepository(PlanningDefault::class);
        $oPlanningDefault = $rPlanningDefault->findOneBy(array('proId' => $oUser->getId()));
        $form = $this->createForm(PlanningDefaultType::class, $oPlanningDefault);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            return $this->render('RdvBundle:Planning:create_default.html.twig', array('form' => $form->createView()));
        }
        return $this->render('RdvBundle:Planning:create_default.html.twig', array('form' => $form->createView()));        
    }
}
