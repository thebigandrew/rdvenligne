<?php

namespace RdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use RdvBundle\Entity\TypeRdv;
use RdvBundle\Entity\Paragraphe;
use RdvBundle\Form\TypeRdvType;
use RdvBundle\Form\ParagrapheType;
use RdvBundle\Form\UserProfileType;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('RdvBundle:Default:index.html.twig');
    }

    public function userProfileAction(Request $request) {
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

    public function typeRdvAction(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryTypeRdv = $entityManager->getRepository(TypeRdv::class);
        $tTypeRdv = $repositoryTypeRdv->findAll();
        return $this->render('RdvBundle:Default:typerdv.html.twig', array('tTypeRdv' => $tTypeRdv));
    }

    public function typeRdvAddUpdateAction(Request $request, $id) {
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryTypeRdv = $entityManager->getRepository(TypeRdv::class);
        if ($id != null) {
            $oTypeRdv = $repositoryTypeRdv->findOneBy(array('id' => $id));
        } else {
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
    }

    public function pagePersoAction(Request $request, $id) {
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryParagraphe = $entityManager->getRepository(Paragraphe::class);
        $tParagraphe = $repositoryParagraphe->findBy(['professionnelId' => $id], ['id' => 'ASC']);
        return $this->render('RdvBundle:Default:pagePerso.html.twig', array('tParagraphe' => $tParagraphe));
    }

    public function pagePersoAddUpdateAction(Request $request, $id) {
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryParagraphe = $entityManager->getRepository(Paragraphe::class);
        if ($id != null) {
            $oParagraphe = $repositoryParagraphe->findOneBy(array('id' => $id));
        } else {
            $oParagraphe = new Paragraphe();
        }
        $form = $form = $this->createForm(ParagrapheType::class, $oParagraphe);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $entityManager->persist($oParagraphe);
            $entityManager->flush();
            $tParagraphe = $repositoryParagraphe->findAll();
            return $this->render('RdvBundle:Default:pageperso.html.twig', array('tParagraphe' => $tParagraphe));
        }
        return $this->render('RdvBundle:Default:paragrapheaddupdate.html.twig', array('form' => $form->createView()));
    }

}
