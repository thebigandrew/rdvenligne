<?php

namespace RdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use RdvBundle\Entity\User;
use RdvBundle\Entity\LieuRdv;
use RdvBundle\Entity\TypeRdv;
use RdvBundle\Entity\Rdv;
use RdvBundle\Entity\Fermeture;
use RdvBundle\Entity\Paragraphe;
use RdvBundle\Entity\PlanningDefault;
use RdvBundle\Form\ProProfileType;
use RdvBundle\Form\RdvType;
use RdvBundle\Form\FermetureType;
use RdvBundle\Form\SearchType;
use RdvBundle\Form\LieuRdvType;
use RdvBundle\Form\LieuRdvDeleteType;
use RdvBundle\Form\TypeRdvType;
use RdvBundle\Form\TypeRdvDeleteType;
use RdvBundle\Form\UserProfileType;
use RdvBundle\Form\ParagrapheType;
use RdvBundle\Form\ParagrapheDeleteType;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use \DateTime;
use \DateInterval;
use \DatePeriod;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $isAjax = $request->isXmlHttpRequest();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $datatable = null;
            $entityManager = $this->getDoctrine()->getManager();
            if ($user->hasRole('ROLE_ADMIN')) {
                $repositoryUser = $entityManager->getRepository(User::class);
                $nbPro = $repositoryUser->getNbUser('ROLE_PRO');
                $nbClient = $repositoryUser->getNbUser('ROLE_CLIENT');
                $arrayMetier = $repositoryUser->getNbMetierUser();
                $repositoryRDV = $entityManager->getRepository(RDV::class);
                $nbRDV = $repositoryRDV->getNbRDV('ROLE_PRO');

                $data = array();
                $pieChart = new PieChart();
                $data[] = ['Métier', 'Nombre'];
                foreach ($arrayMetier as $id => $value) {
                    $data[] = [0 => ($value['metier'] != '' ? $value['metier'] : "Non défini"), 1 => (int) $value['nb']];
                }
                $pieChart->getData()->setArrayToDataTable($data);
                $pieChart->getOptions()->setTitle('Métier des Professionnels');
                $pieChart->getOptions()->setIs3D(TRUE);
                $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
                $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
                $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
                $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
                $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

                $arrayDateRDV = $repositoryRDV->getNbRDVDate();
                foreach ($arrayDateRDV as $value) {
                    $arrayRDV[$value['month']] = $value;
                }
                $data = array();
                $columnChart = new ColumnChart();
                $data[] = ['Date', 'Nombre de RDV'];
                $month = ['', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                $data[] = [0 => $month[date('n', strtotime('-5 MONTH'))], 1 => (int) (isset($arrayRDV[date('n', strtotime('-5 MONTH'))]['nb']) ? $arrayRDV[date('n', strtotime('-5 MONTH'))]['nb'] : 0)];
                $data[] = [0 => $month[date('n', strtotime('-4 MONTH'))], 1 => (int) (isset($arrayRDV[date('n', strtotime('-4 MONTH'))]['nb']) ? $arrayRDV[date('n', strtotime('-4 MONTH'))]['nb'] : 0)];
                $data[] = [0 => $month[date('n', strtotime('-3 MONTH'))], 1 => (int) (isset($arrayRDV[date('n', strtotime('-3 MONTH'))]['nb']) ? $arrayRDV[date('n', strtotime('-3 MONTH'))]['nb'] : 0)];
                $data[] = [0 => $month[date('n', strtotime('-2 MONTH'))], 1 => (int) (isset($arrayRDV[date('n', strtotime('-2 MONTH'))]['nb']) ? $arrayRDV[date('n', strtotime('-2 MONTH'))]['nb'] : 0)];
                $data[] = [0 => $month[date('n', strtotime('-1 MONTH'))], 1 => (int) (isset($arrayRDV[date('n', strtotime('-1 MONTH'))]['nb']) ? $arrayRDV[date('n', strtotime('-1 MONTH'))]['nb'] : 0)];
                $data[] = [0 => $month[date('n')], 1 => (int) (isset($arrayRDV[date('n')]['nb']) ? $arrayRDV[date('n')]['nb'] : 0)];
                $data[] = [0 => $month[date('n', strtotime('+1 MONTH'))], 1 => (int) (isset($arrayRDV[date('n', strtotime('+1 MONTH'))]['nb']) ? $arrayRDV[date('n', strtotime('+1 MONTH'))]['nb'] : 0)];

                $columnChart->getData()->setArrayToDataTable($data);
                $columnChart->getOptions()->setTitle('RDV des 5 derniers mois');
                $columnChart->getOptions()->getTitleTextStyle()->setBold(true);
                $columnChart->getOptions()->getTitleTextStyle()->setColor('#009900');
                $columnChart->getOptions()->getTitleTextStyle()->setItalic(true);
                $columnChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
                $columnChart->getOptions()->getTitleTextStyle()->setFontSize(20);
                return $this->render('RdvBundle:Default:index.html.twig', array(
                            'nbPro' => $nbPro,
                            'nbClient' => $nbClient,
                            'nbRDV' => $nbRDV,
                            'piechart' => $pieChart,
                            'columnChart' => $columnChart
                ));
            } elseif ($user->hasRole('ROLE_PRO')) {
                $datatable = $this->get('app.datatable.pro_rdv_list');
                $datatable->buildDatatable();
                if ($isAjax) {
                    $responseService = $this->get('sg_datatables.response');
                    $responseService->setDatatable($datatable);
                    $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();

                    $qb = $datatableQueryBuilder->getQb()
                            ->andWhere("rdv.proId = :id")
                            ->setParameter('id', $user->getId())
                            ->andWhere("rdv.creneauxDebut >= :now")
                            ->setParameter('now', new \DateTime('now'));
                    return $responseService->getResponse();
                }
                return $this->render('RdvBundle:Default:index.html.twig', array(
                            'datatable' => $datatable,
                ));
            } elseif ($user->hasRole('ROLE_CLIENT')) {
                $datatable = $this->get('app.datatable.user_rdv_list');
                $datatable->buildDatatable();
                $user = $this->get('security.token_storage')->getToken()->getUser();
                if ($isAjax) {
                    $responseService = $this->get('sg_datatables.response');
                    $responseService->setDatatable($datatable);
                    $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();

                    $qb = $datatableQueryBuilder->getQb()
                            ->andWhere("rdv.userId = :id")
                            ->setParameter('id', $user->getId())
                            ->andWhere("rdv.creneauxDebut >= :now")
                            ->setParameter('now', new \DateTime('now'));
                    return $responseService->getResponse();
                }
                
                $form = $this->createForm(SearchType::class, null);
                $form->handleRequest($request);
                
                if($form->isSubmitted() and $form->isValid()){
                    $repositoryUser = $entityManager->getRepository(User::class);
                    $tPros = $repositoryUser->getProsByNom($form['text']->getData());
                    return $this->render('RdvBundle:Default:foundPros.html.twig', array(
                        'tPros' => $tPros
                    ));
                }
                return $this->render('RdvBundle:Default:index.html.twig', array(
                            'datatable' => $datatable,
                            'form' => $form->createView()
                ));
            }
            return $this->render('RdvBundle:Default:index.html.twig');
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }

    public function userProfileAction(Request $request) {
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
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }

    public function proProfileAction(Request $request) {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $entityManager = $this->getDoctrine()->getManager();
            $oUser = $this->getUser();
            $repositoryLieuRdv = $entityManager->getRepository(LieuRdv::class);
            $tLieuRdv = $repositoryLieuRdv->findBy(array('proId' => $oUser->getId(), 'enable' => true));
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
                return $this->render('RdvBundle:Default:proprofile.html.twig', array('form' => $form->createView(), 'tLieuRdv' => $tLieuRdv));
            }
            return $this->render('RdvBundle:Default:proprofile.html.twig', array('form' => $form->createView(), 'tLieuRdv' => $tLieuRdv));
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }

    public function addLieuRdvAction(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        $oUser = $this->getUser();
        $oLieuRdv = new LieuRdv();
        $oLieuRdv->setNom($_POST['strNom']);
        $oLieuRdv->setAdresse($_POST['strAdr']);
        $oLieuRdv->setProId($oUser);
        $oLieuRdv->setEnable(true);
        $entityManager->persist($oLieuRdv);
        $entityManager->flush();
        $repositoryLieuRdv = $entityManager->getRepository(LieuRdv::class);
        $tLieuRdv = $repositoryLieuRdv->findBy(array('proId' => $_POST['idUser'], 'enable' => true));
        return $this->render('RdvBundle:Default:tablelieurdv.html.twig', array('tLieuRdv' => $tLieuRdv));
    }

    public function pagePersoAction(Request $request, $id) {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $entityManager = $this->getDoctrine()->getManager();
            $repositoryUser = $entityManager->getRepository(User::class);
            $id = ($id == NULL ? $this->get('security.token_storage')->getToken()->getUser()->getId() : $id);
            $tUser = $repositoryUser->findOneBy(['id' => $id]);
            if ($tUser->hasRole('ROLE_PRO')) {
                $myId = $this->get('security.token_storage')->getToken()->getUser()->getId();
                $repositoryParagraphe = $entityManager->getRepository(Paragraphe::class);
                $tParagraphe = $repositoryParagraphe->findBy(['professionnelId' => $id, 'enable' => true], ['id' => 'ASC']);

                $repositoryLieuRdv = $entityManager->getRepository(LieuRdv::class);
                $tLieuRdv = $repositoryLieuRdv->findBy(['proId' => $id, 'enable' => TRUE], ['id' => 'ASC']);

                $repositoryTypeRdv = $entityManager->getRepository(TypeRdv::class);
                $tTypeRdv = $repositoryTypeRdv->findBy(['proId' => $id, 'enable' => TRUE], ['id' => 'ASC']);

                $repositoryRdv = $entityManager->getRepository(Rdv::class);
                $nbUser = $repositoryRdv->getNb($id);

                return $this->render('RdvBundle:Default:pagePerso.html.twig', array(
                            'tPro' => $tUser,
                            'tParagraphe' => $tParagraphe,
                            'tLieuRdv' => $tLieuRdv,
                            'nbUser' => $nbUser,
                            'tTypeRdv' => $tTypeRdv,
                            'is_user' => ($id == $myId)
                ));
            }
        }
        return $this->redirectToRoute('fos_user_security_login');
    }

    public function pagePersoAddUpdateAction(Request $request, $id) {
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryParagraphe = $entityManager->getRepository(Paragraphe::class);
        if ($id != null) {
            $oParagraphe = $repositoryParagraphe->findOneBy(array('id' => $id));
        } else {
            $oParagraphe = new Paragraphe();
        }
        $form = $this->createForm(ParagrapheType::class, $oParagraphe);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            if ($id == null) {
                $oParagraphe->setDateCreation(new \DateTime("now"));
                $oParagraphe->setProfessionnelId($this->getUser());
                $oParagraphe->setEnable(TRUE);
            }
            $oParagraphe->setDateModification(new \DateTime("now"));
            $entityManager->persist($oParagraphe);
            $entityManager->flush();
            $idPro = $this->get('security.token_storage')->getToken()->getUser()->getId();
            return $this->redirectToRoute('pagePerso', ['id' => $idPro]);
        }
        return $this->render('RdvBundle:Default:paragrapheaddupdate.html.twig', array('form' => $form->createView(), 'id' => $id));
    }

    public function pagePersoDeleteAction(Request $request, $id) {
        $idPro = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryParagraphe = $entityManager->getRepository(Paragraphe::class);
        if ($id != null) {
            $oParagraphe = $repositoryParagraphe->findOneBy(array('id' => $id));
            $form = $this->createForm(ParagrapheDeleteType::class, $oParagraphe);
            $form->handleRequest($request);
            if ($form->isSubmitted() and $form->isValid()) {
                $oParagraphe->setEnable(FALSE);
                $entityManager->persist($oParagraphe);
                $entityManager->flush();
                return $this->redirectToRoute('pagePerso', ['id' => $idPro]);
            }
            return $this->render('RdvBundle:Default:paragraphedelete.html.twig', array('form' => $form->createView(), 'id' => $id));
        }
        return $this->redirectToRoute('pagePerso', ['id' => $idPro]);
    }

    public function typeRdvAddUpdateAction(Request $request, $id) {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
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
                $oTypeRdv->setProId($this->getUser());
                $oTypeRdv->setEnable(TRUE);
                $entityManager->persist($oTypeRdv);
                $entityManager->flush();
                $idPro = $this->get('security.token_storage')->getToken()->getUser()->getId();
                return $this->redirectToRoute('pagePerso', ['id' => $idPro]);
            }
            return $this->render('RdvBundle:Default:typerdvaddupdate.html.twig', array('form' => $form->createView()));
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }

    public function typeRdvDeleteAction(Request $request, $id) {
        $idPro = $this->get('security.token_storage')->getToken()->getUser()->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $repositoryTypeRdv = $entityManager->getRepository(TypeRdv::class);
        if ($id != null) {
            $oTypeRdv = $repositoryTypeRdv->findOneBy(array('id' => $id));
            $form = $this->createForm(TypeRdvDeleteType::class, $oTypeRdv);
            $form->handleRequest($request);
            if ($form->isSubmitted() and $form->isValid()) {
                $oTypeRdv->setEnable(FALSE);
                $entityManager->persist($oTypeRdv);

                $oLieuRdv = $entityManager->getRepository(LieuRdv::class)->findBy(array('proId' => $idPro));
                $oTypeRdv = $entityManager->getRepository(TypeRdv::class)->find(array('id' => $id));
                foreach ($oLieuRdv as $idLieuRdv) {
                    $oLieuRdv2 = $entityManager->getRepository(LieuRdv::class)->find($idLieuRdv);
                    $oLieuRdv2->removeTypeRdv($oTypeRdv);
                    $entityManager->persist($oLieuRdv2);
                }

                $entityManager->flush();
                return $this->redirectToRoute('pagePerso', ['id' => $idPro]);
            }
            return $this->render('RdvBundle:Default:typeRdvDelete.html.twig', array('form' => $form->createView(), 'id' => $id));
        }
        return $this->redirectToRoute('pagePerso', ['id' => $idPro]);
    }

    public function UserRdvAction(Request $request) {
        $isAjax = $request->isXmlHttpRequest();
        $datatable = $this->get('app.datatable.user_rdv_list');
        $datatable->buildDatatable();

        if ($isAjax) {
            $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($datatable);
            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();

            $qb = $datatableQueryBuilder->getQb();
            $qb->andWhere("rdv.userId = '" . $id . "'");

            return $responseService->getResponse();
        }

        return $this->render('RdvBundle:RdvUserList:index.html.twig', array(
                    'datatable' => $datatable,
        ));
    }

    public function ListingProAction(Request $request) {
        $isAjax = $request->isXmlHttpRequest();
        $datatable = $this->get('rdv.datatable.user');
        $datatable->buildDatatable();

        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($datatable);
            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();

            $qb = $datatableQueryBuilder->getQb();
            $qb->andWhere('user.roles LIKE :role AND users.validationAdmin = true');
            $qb->setParameter('role', '%"ROLE_PRO"%');

            return $responseService->getResponse();
        }

        return $this->render('RdvBundle:ListingPro:index.html.twig', array(
                    'datatable' => $datatable,
        ));
    }

    public function lieuRdvAddUpdateAction(Request $request, $id) {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $idPro = $this->get('security.token_storage')->getToken()->getUser()->getId();
            $entityManager = $this->getDoctrine()->getManager();
            $repositoryLieuRdv = $entityManager->getRepository(LieuRdv::class);
            if ($id != null) {
                $oLieuRdv = $repositoryLieuRdv->findOneBy(array('id' => $id));
            } else {
                $oLieuRdv = new LieuRdv();
            }
            $form = $this->createForm(LieuRdvType::class, $oLieuRdv, array('idPro' => $idPro));
            $form->handleRequest($request);
            if ($form->isSubmitted() and $form->isValid()) {
                $oLieuRdv->setProId($this->getUser());
                $oLieuRdv->setEnable(TRUE);
                $entityManager->persist($oLieuRdv);
                $entityManager->flush();
                return $this->redirectToRoute('pagePerso', ['id' => $idPro]);
            }
            return $this->render('RdvBundle:Default:lieurdvaddupdate.html.twig', array('form' => $form->createView()));
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }

    public function lieuRdvDeleteAction(Request $request, $id) {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $idPro = $this->get('security.token_storage')->getToken()->getUser()->getId();
            $entityManager = $this->getDoctrine()->getManager();
            $repositoryTypeRdv = $entityManager->getRepository(LieuRdv::class);
            if ($id != null) {
                $oLieuRdv = $repositoryTypeRdv->findOneBy(array('id' => $id));
                $form = $this->createForm(LieuRdvDeleteType::class, $oLieuRdv);
                $form->handleRequest($request);
                if ($form->isSubmitted() and $form->isValid()) {
                    $oLieuRdv->setEnable(FALSE);
                    $entityManager->persist($oLieuRdv);

                    $oTypeRdv = $entityManager->getRepository(TypeRdv::class)->findBy(array('proId' => $idPro));
                    foreach ($oTypeRdv as $idTypeRdv) {
                        $oTypeRdv2 = $entityManager->getRepository(TypeRdv::class)->find($idTypeRdv);
                        $oLieuRdv->removeTypeRdv($oTypeRdv2);
                        $entityManager->persist($oLieuRdv);
                    }

                    $entityManager->flush();
                    return $this->redirectToRoute('pagePerso', ['id' => $idPro]);
                }
                return $this->render('RdvBundle:Default:lieuRdvDelete.html.twig', array('form' => $form->createView(), 'id' => $id));
            }
            return $this->redirectToRoute('pagePerso', ['id' => $idPro]);
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }

    public function addRdvProAction(Request $request, $id) {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $entityManager = $this->getDoctrine()->getManager();
            $repositoryRdv = $entityManager->getRepository(Rdv::class);
            if ($id != null) {
                $oRdv = $repositoryRdv->findOneBy(array('id' => $id));
            } else {
                $oRdv = new Rdv();
            }
            $form = $this->createForm(RdvType::class, $oRdv, array('user' => $this->getUser()));
            $form->handleRequest($request);
            $oDateTimeCurrent = new \DateTime('now');
            $session = new Session();
            if ($form->isSubmitted() and $form->isValid()) {
                if ($oRdv->getCreneauxDebut() < $oRdv->getCreneauxFin() and $oRdv->getCreneauxDebut() > $oDateTimeCurrent
                        and $oRdv->getCreneauxDebut()->format('Y-m-d') == $oRdv->getCreneauxFin()->format('Y-m-d')) {
                    $oRdv->setValidation(true);
                    $oRdv->setStatut(true);
                    $oRdv->setProId($this->getUser());
                    $entityManager->persist($oRdv);
                    $entityManager->flush();
                    $session->getFlashBag()->add(
                            'success', 'RDV ajouté avec succès'
                    );
                    return $this->redirectToRoute('rdv_homepage');
                } else {
                    $session->getFlashBag()->add(
                            'error', 'Les dates saisies sont invalides'
                    );
                    return $this->render('RdvBundle:Default:rdvaddupdate.html.twig', array('form' => $form->createView()));
                }
            }
            return $this->render('RdvBundle:Default:rdvaddupdate.html.twig', array('form' => $form->createView()));
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
    
    public function planningHebdoAction(Request $request){
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {  
            $oDateCurrent = new \DateTime('now');
            $oDateDeb = clone $oDateCurrent->modify('Monday this week');
            $oDateFin = clone $oDateCurrent->modify('Sunday this week');
            $oDateDebLastWeek = new \DateTime($oDateDeb->format('Y-m-d'));
            $oDateDebNextWeek = new \DateTime($oDateDeb->format('Y-m-d'));
            $oDateDebLastWeek->modify('Monday last week');
            $oDateDebNextWeek->modify('Monday next week');
            if($request->isXmlHttpRequest()){
                $oDateCurrent = new \DateTime('now');
                $oDateDeb = new \DateTime($_POST['start']);
                $oDateFin = new \DateTime($_POST['end']);
                $entityManager = $this->getDoctrine()->getManager();
                $repositoryRdv = $entityManager->getRepository(Rdv::class);  
                $tRdv = $repositoryRdv->getRdvBetweenDates($oDateDeb, $oDateFin, $this->getUser());                
                return new JsonResponse($tRdv);
            } else {
                return $this->render('RdvBundle:Default:planninghebdo.html.twig');
            }
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
	
	public function closeManagerAction(Request $request){
		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			$isAjax = $request->isXmlHttpRequest();
			$datatable = $this->get('app.datatable.fermeture');
			$datatable->buildDatatable();

			if ($isAjax) {
				$id = $this->get('security.token_storage')->getToken()->getUser()->getId();
				$responseService = $this->get('sg_datatables.response');
				$responseService->setDatatable($datatable);
				$datatableQueryBuilder = $responseService->getDatatableQueryBuilder();

				$qb = $datatableQueryBuilder->getQb();
				$qb->andWhere("fermeture.user = '" . $id . "'");

				return $responseService->getResponse();
			}

			return $this->render('RdvBundle:Default:fermeture.html.twig', array(
						'datatable' => $datatable,
			));
		}else{
			return $this->redirectToRoute('fos_user_security_login');
		}
	}
	
	public function addUpdateFermetureAction(Request $request, $id){
		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) { 
			$entityManager = $this->getDoctrine()->getManager();
            $repositoryFermeture = $entityManager->getRepository(Fermeture::class);
            if ($id != null) {
                $oFermeture = $repositoryFermeture->findOneBy(array('id' => $id));
            } else {
                $oFermeture = new Fermeture();
            }
            $form = $this->createForm(FermetureType::class, $oFermeture);
            $form->handleRequest($request);
            if ($form->isSubmitted() and $form->isValid()) {
                $oCurrentDate = new \DateTime('now');
                if($oFermeture->getDatedebut() > $oCurrentDate and $oFermeture->getDatefin() > $oFermeture->getDatedebut()){
                    $oFermeture->setUser($this->getUser());
                    $entityManager->persist($oFermeture);
                    $entityManager->flush();
                    return $this->redirectToRoute('close_manager');
                }else{
                    $session = new Session();
                    $session->getFlashBag()->add('error', 'Dates invalides');
                    return $this->render('RdvBundle:Default:fermetureaddupdate.html.twig', array('form' => $form->createView()));
                }
                
            }
            return $this->render('RdvBundle:Default:fermetureaddupdate.html.twig', array('form' => $form->createView()));
		}else{
			return $this->redirectToRoute('fos_user_security_login');
		}
	}
	
	public function deleteFermetureAction(Request $request, $id){
		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) { 
			$entityManager = $this->getDoctrine()->getManager();
			$repositoryFermeture = $entityManager->getRepository(Fermeture::class);
			$oFermeture = $repositoryFermeture->findOneBy(array('id' => $id));
			$entityManager->remove($oFermeture);
			$entityManager->flush();
			return $this->redirectToRoute('close_manager');
		}else{
			return $this->redirectToRoute('fos_user_security_login');
		}
	}
        
    public function rechercheCreneauxAction(Request $request, $id){
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            
            $proId = $id;
            
             $form = $this->createFormBuilder()
            ->add('typeDeRdv', EntityType::class, [
                'class' => TypeRdv::class,
                'choice_label' => 'type',
                'query_builder' => function(EntityRepository $er ) use ( $proId ) {
                    return $er->createQueryBuilder('tr')
                              ->where('tr.proId = :proId')
                              ->setParameter('proId', $proId);
                },
                'attr' => array(
                    'onChange' => 'changeTypeRdv()'
                )
            ])
            ->getForm();

            return $this->render('RdvBundle:Default:rechercheCreneaux.html.twig', array(
                'form' => $form->createView(),
                'proId' => $proId
            ));
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
        
    public function rechercheCreneauxJsonAction(Request $request, $id){
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            
            $proId = $id;
            
            $joursSemaine = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            
            $em = $this->getDoctrine()->getManager();
            $repositoryTypeRdv = $em->getRepository(TypeRdv::class);
            $repositoryPlanningDefault = $em->getRepository(PlanningDefault::class);
            $repositoryRdv = $em->getRepository(Rdv::class);
            $repositoryFermeture = $em->getRepository(Fermeture::class);
            
            // Récupération du rdv le plus cours.
            $shortestTypeRdv = $repositoryTypeRdv->getShortestTypeRdvForPro( $proId)[0];
            
            // Récupération du planning par défaut
            $planning = $repositoryPlanningDefault->findOneByProId($proId);
            
            $creneauxSemaineCourante = [];
            
            $i = 1;
            
            $start = new DateTime($_POST['start']);
            
            // On récupère l'id du type de rdv pour le lequel on veut les créneaux.
            $idTypeRdv = $_POST['typeRdvId'];
            
            $typeRdv = $repositoryTypeRdv->findOneById($idTypeRdv);
            
            // Sert pour définir la fin des créneaux.
            $typeRdvIntervalFormat = $typeRdv->getDuree()->format('\P\TH\Hi\M');
            
            // On définit le pas de début de créneaux.
            $dateIntervalFormat = $shortestTypeRdv->getDuree()->format('\P\TH\Hi\M');
            
            foreach( $planning->getPlanningDays() as $day)
            {
                
                if($day->getActiveDay() == true)
                {
                    // Si lieu existant alors vérifier si la prestation est dispo
                    if($day->getLieu() !== null)
                    {
                        if($day->getLieu()->getTypeRdv()->contains($typeRdv) === true)
                        {
                            // La prestation est disponible sur le lieu du jour en cours de traitement, on continue.
                        }
                        else
                        {
                            // La prestation n'est pas disponible sur le lieu de rdv du jour en question, il faut donc passer.
                            // Il faut passer au jour suivant avant de reboucler
                            $start->add(new DateInterval('P1D'));
                            // Avec cette instruction on remonte en haut de la boucle et on passe au jour suivant.
                            continue;
                        }
                    }
                    // pas de lieu de rdv donc open bar sur la journée
                    else
                    {
                        // Ne rien faire on continue simplement le fil d'execution
                    }
                
                    // ajuster l'heure de début
                    $start->setTime(
                        $day->getHeureDebut()->format('H'),
                        $day->getHeureDebut()->format('m')
                    );
                    
                    // enlever une minute pour corriger le bug qui fait que le premier crénaux débute 1 minute après le début de la journée
                    $start->sub(new DateInterval('PT1M'));
                    
                    
                    // obtenir le jour de la semaine correspondant example: 'this wednesday'.
                    $end = clone $start;
                    // ajuster l'heure de fin
                    $end->setTime(
                        $day->getHeureFin()->format('H'),
                        $day->getHeureFin()->format('m')
                    );
                    
                    // générer l'interval du jour en question
                    $period = new DatePeriod(
                        $start,
                        new DateInterval( $dateIntervalFormat ),
                        $end
                    );
                    
                    // itérer sur tous les crénaux de la journée
                    foreach($period as $value)
                    {
                        $currentDateTime = new \DateTime();
                        
                        // Ne pas afficher les créneaux pour les heures / jours passés
                        if( $currentDateTime < $value)
                        {
                            // le créneaux de fin est le créneaux de début + la durée du rdv que l'on recherche.
                            $endCreneaux = clone $value;
                            $endCreneaux->add(new DateInterval( $typeRdvIntervalFormat ));

                            // Il ne faut pas qu'un rdv se termine après la fin de la journée
                            if( $endCreneaux < $end )
                            {
                                // Récuperer le nombre de rdv qui s'overlap sur la période du créneaux.
                                $overlappingRdv = $repositoryRdv->countOverlappingRdv($proId, $value, $endCreneaux);
                                $nbFermeture = $repositoryFermeture->creneauxEstSurFermeture($proId, $value, $endCreneaux);
                                if( ($overlappingRdv < $day->getNbcreneaux()) && ($nbFermeture == 0))
                                {
                                    // Le créneaux rempli toutes les conditions, on peut l'ajouter.
                                    array_push($creneauxSemaineCourante, [
                                        'title' => 'crénaux ' . ($i++),
                                        'start' => $value->format('Y-m-d H:i:s'),
                                        'end' => $endCreneaux->format('Y-m-d H:i:s'),
                                        'pro' => $proId,
                                        'typerdv' => $idTypeRdv,
                                        // attention le lieu peut être nul
                                        'lieu' => $day->getLieu()
                                    ]);
                                }
                            }
                        }
                    }
                }
                
                // jour suivant
                $start->add(new DateInterval('P1D'));
            }

            // tmp
            return new JsonResponse($creneauxSemaineCourante);
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
	
    public function confirmRdvAction(Request $request){
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $strUri = explode('/', $request->getRequesturi());
            $strParams = $strUri[5];
            $strParams = str_replace('confirm?', '', $strParams);
            $strParams = str_replace('&amp;', ' ', $strParams);
            $tParams = explode(' ', $strParams);

            $proParamStr = $tParams[0];
            $startParamStr = $tParams[1];
            $endParamStr = $tParams[2];
            $typeParamStr = $tParams[3];
            $lieuParamStr = $tParams[4];

            $proId = str_replace('pro=', '', $proParamStr);
            $typeId = str_replace('type=', '', $typeParamStr);
            $lieuId = str_replace('lieu=', '', $lieuParamStr);

            $startDateFormat = str_replace('%20', ' ', $startParamStr);
            $startDateFormat = str_replace('start=', '', $startDateFormat);
            $oStartDate = new \DateTime($startDateFormat);

            $endDateFormat = str_replace('%20', ' ', $endParamStr);
            $endDateFormat = str_replace('end=', '', $endDateFormat);
            $oEndDate = new \DateTime($endDateFormat);
			
            $em = $this->getDoctrine()->getManager();
            $repositoryTypeRdv = $em->getRepository(TypeRdv::class);
            $repositoryLieu = $em->getRepository(LieuRdv::class);
            $repositoryUser = $em->getRepository(User::class);
			
            $oPro = $repositoryUser->findOneBy(array('id' => $proId));
            $oTypeRdv = $repositoryTypeRdv->findOneBy(array('id' => $typeId));
            $oLieu = $repositoryLieu->findOneBy(array('id' => $lieuId));
            $oClient = $this->getUser();

            $oRdv = new Rdv();
            $oRdv->setTypeId($oTypeRdv);
            $oRdv->setProId($oPro);
            $oRdv->setUserId($oClient);
            $oRdv->setStatut(false);
            $oRdv->setValidation(false);
            $oRdv->setLieu($oLieu);
            $oRdv->setCreneauxDebut($oStartDate);
            $oRdv->setCreneauxFin($oEndDate);
            $em->persist($oRdv);
            $em->flush();
            
            // envoi mail pro. Désactivé par défault pour ne pas spammer le client.
            /*$messagePro = (new \Swift_Message('Confirmation rdv'))
                ->setFrom($this->getParameter('mailer_user'))
                ->setTo($oRdv->getProId()->getEmail())
                ->setBody(
                    $this->renderView(
                        'RdvBundle:Email:confirmation_pro.html.twig', array(
                            'oRdv' => $oRdv
                        )
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($messagePro);*/

            
            // Envoi mail client.
            $message = (new \Swift_Message('Confirmation rdv'))
                ->setFrom($this->getParameter('mailer_user'))
                ->setTo($oRdv->getUserId()->getEmail())
                ->setBody(
                    $this->renderView(
                        'RdvBundle:Email:confirmation_client.html.twig', array(
                            'oRdv' => $oRdv
                        )
                    ),
                    'text/html'
                );

            $this->get('mailer')->send($message);

                return $this->render('RdvBundle:Default:confirmRdv.html.twig', array(
                    'oRdv' => $oRdv
                ));
        }else{
            return $this->redirectToRoute('fos_user_security_login');
        }
    }
	
	public function confirmRdvClientAction(Request $request, $id){
	    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
	        $em = $this->getDoctrine()->getManager();
	        $repositoryRdv = $em->getRepository(Rdv::class);
	        $oRdv = $repositoryRdv->findOneBy(array('id' => $id));
	        $oRdv->setStatut(true);
	        $em->flush();
	        $session = new Session();
	        $session->getFlashBag()->add(
	            'success', 'RDV réservé avec succès'
	        );
                
                // envoi mail pro. Désactivé par défault pour ne pas spammer le client.
                /*$messagePro = (new \Swift_Message('Validation rdv'))
                    ->setFrom($this->getParameter('mailer_user'))
                    ->setTo($oRdv->getProId()->getEmail())
                    ->setBody(
                        $this->renderView(
                            'RdvBundle:Email:validation_rdv_pro.html.twig', array(
                                'oRdv' => $oRdv
                            )
                        ),
                        'text/html'
                    );
                $this->get('mailer')->send($messagePro);*/

                if($oRdv->getUserId() !== null)
                {
                    // Envoi mail client.
                    $message = (new \Swift_Message('Validation rdv'))
                        ->setFrom($this->getParameter('mailer_user'))
                        ->setTo($oRdv->getUserId()->getEmail())
                        ->setBody(
                            $this->renderView(
                                'RdvBundle:Email:validation_rdv_client.html.twig', array(
                                    'oRdv' => $oRdv
                                )
                            ),
                            'text/html'
                        );

                    $this->get('mailer')->send($message);
                }
	        return $this->redirectToRoute('rdv_homepage');
	    }else{
	        return $this->redirectToRoute('fos_user_security_login');
	    }
	}
	
	public function cancelRdvClientAction(Request $request, $id){
	    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
	        $em = $this->getDoctrine()->getManager();
	        $repositoryRdv = $em->getRepository(Rdv::class);
	        $oRdv = $repositoryRdv->findOneBy(array('id' => $id));
	        $oPro = $oRdv->getProId();
	        $proId = $oPro->getId();
	        $em->remove($oRdv);
	        $em->flush();
	        $session = new Session();
	        $session->getFlashBag()->add(
	            'error', 'Réservation annulée'
	        );
                
                // envoi mail pro. Désactivé par défault pour ne pas spammer le client.
                /*$messagePro = (new \Swift_Message('Annulation rdv'))
                    ->setFrom($this->getParameter('mailer_user'))
                    ->setTo($oRdv->getProId()->getEmail())
                    ->setBody(
                        $this->renderView(
                            'RdvBundle:Email:cancel_rdv_pro.html.twig', array(
                                'oRdv' => $oRdv
                            )
                        ),
                        'text/html'
                    );
                $this->get('mailer')->send($messagePro);*/

                if($oRdv->getUserId() !== null)
                {
                    // Envoi mail client.
                    $message = (new \Swift_Message('Annulation rdv'))
                        ->setFrom($this->getParameter('mailer_user'))
                        ->setTo($oRdv->getUserId()->getEmail())
                        ->setBody(
                            $this->renderView(
                                'RdvBundle:Email:cancel_rdv_client.html.twig', array(
                                    'oRdv' => $oRdv
                                )
                            ),
                            'text/html'
                        );

                    $this->get('mailer')->send($message);
                }
                
	        return $this->redirectToRoute('recherche_creneaux', array('id' => $proId));
	    }else{
	        return $this->redirectToRoute('fos_user_security_login');
	    }
	}
}
