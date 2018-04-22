<?php

namespace RdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use RdvBundle\Form\UserProfileType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RdvBundle:Default:index.html.twig');
    }
    
    public function userProfileAction(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $oUser = $this->getUser();
        $form = $this->createForm(UserProfileType::class, $oUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $oUser->setTelephone($form['telephone']->getData());
            $oUser->setEmail($form['email']->getData());
            $oUser->setDateNaissance($form['dateNaissance']->getData());
            $oUser->setLastname($form['lastName']->getData());
            $oUser->setFirstname($form['firstName']->getData());
            $oUser->setUsername($form['userName']->getData());
            $entityManager->flush();
            return $this->render('RdvBundle:Default:userprofile.html.twig', array('form' => $form->createView()));
        }
        return $this->render('RdvBundle:Default:userprofile.html.twig', array('form' => $form->createView()));
    }
}
