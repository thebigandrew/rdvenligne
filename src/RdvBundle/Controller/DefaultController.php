<?php

namespace RdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use RdvBundle\Entity\TypeRdv;
use RdvBundle\Form\ProProfileType;
use RdvBundle\Form\TypeRdvType;
use RdvBundle\Form\UserProfileType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->render('RdvBundle:Default:index.html.twig');
        }else{
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
    
    public function userProfileAction(Request $request){
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
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
        }else{
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
    
    public function typeRdvAction(Request $request){
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $isAjax = $request->isXmlHttpRequest();
            
            // Get your Datatable ...
            //$datatable = $this->get('app.datatable.post');
            //$datatable->buildDatatable();
            
            // or use the DatatableFactory
            /** @var DatatableInterface $datatable */
            $datatable = $this->get('app.datatable.typerdv');
            $datatable->buildDatatable();
            if ($isAjax) {
                $responseService = $this->get('sg_datatables.response');
                $responseService->setDatatable($datatable);
                $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
                
                $qb = $datatableQueryBuilder->getQb();
                
                return $responseService->getResponse();
            }
            return $this->render('RdvBundle:Default:typerdv.html.twig', array(
                'datatable' => $datatable,
            ));
        }else{
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
    
    public function typeRdvAddUpdateAction(Request $request, $id){
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $entityManager = $this->getDoctrine()->getManager();
            $repositoryTypeRdv = $entityManager->getRepository(TypeRdv::class);
            if($id != null){
                $oTypeRdv = $repositoryTypeRdv->findOneBy(array('id' => $id));
            }else{
                $oTypeRdv = new TypeRdv();
            }
            $form = $form = $this->createForm(TypeRdvType::class, $oTypeRdv);
            $form->handleRequest($request);
            if ($form->isSubmitted() and $form->isValid()) {
                $entityManager->persist($oTypeRdv);
                $entityManager->flush();
                $tTypeRdv = $repositoryTypeRdv->findAll();
                return $this->render('RdvBundle:Default:typerdv.html.twig', array('tTypeRdv' => $tTypeRdv));
            }
            return $this->render('RdvBundle:Default:typerdvaddupdate.html.twig', array('form' => $form->createView()));
        }else{
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
    
    public function proProfileAction(Request $request){
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $entityManager = $this->getDoctrine()->getManager();
            $oUser = $this->getUser();
            $form = $this->createForm(ProProfileType::class, $oUser);
            $form->handleRequest($request);
            if ($form->isSubmitted() and $form->isValid()) {
                $oUser->setTelephone($form['telephone']->getData());
                $oUser->setEmail($form['email']->getData());
                $oUser->setDateNaissance($form['dateNaissance']->getData());
                $oUser->setLastname($form['lastName']->getData());
                $oUser->setFirstname($form['firstName']->getData());
                $oUser->setUsername($form['userName']->getData());
                $oUser->setMetier($form['metier']->getData());
                $entityManager->flush();
                return $this->render('RdvBundle:Default:proprofile.html.twig', array('form' => $form->createView()));
            }
            return $this->render('RdvBundle:Default:proprofile.html.twig', array('form' => $form->createView()));
        }else{
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
}
