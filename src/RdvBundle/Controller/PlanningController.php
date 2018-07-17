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
        $rDayPlanningDefault = $entityManager->getRepository(DayPlanningDefault::class);
        $oPlanningDefault = $rPlanningDefault->findOneBy(array('proId' => $oUser->getId()));
        $form = $this->createForm(PlanningDefaultType::class, $oPlanningDefault, [
            'idPro' => $this->getUser()->getId()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $pDays = $form->get('planningDays');
            foreach($pDays as $day){
                $idDay = $day->getViewData()->getId();
                $oDayPlanningDefault = $rDayPlanningDefault->findOneBy(array('id' => $idDay));
                $oDayPlanningDefault->setPlanningDefaultId($day->getViewData()->getPlanningDefaultId());
                $oDayPlanningDefault->setActiveDay($day->getViewData()->getActiveDay());
                $oDayPlanningDefault->setHeureDebut($day->getViewData()->getHeureDebut());
                $oDayPlanningDefault->setHeureFin($day->getViewData()->getHeureFin());
                $oDayPlanningDefault->setNbcreneaux($day->getViewData()->getNbcreneaux());
                $entityManager->flush($oDayPlanningDefault);
            }
            return $this->render('RdvBundle:Planning:create_default.html.twig', array('form' => $form->createView()));
        }
        return $this->render('RdvBundle:Planning:create_default.html.twig', array('form' => $form->createView()));        
    }
}
