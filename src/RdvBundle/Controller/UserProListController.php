<?php

namespace RdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserProListController extends Controller {

    public function indexAction(Request $request) {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $isAjax = $request->isXmlHttpRequest();

            // Get your Datatable ...
            //$datatable = $this->get('app.datatable.post');
            //$datatable->buildDatatable();
            // or use the DatatableFactory
            /** @var DatatableInterface $datatable */
            $datatable = $this->get('app.datatable.user_pro_datatable');
            $datatable->buildDatatable();

            if ($isAjax) {
                $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
                $responseService = $this->get('sg_datatables.response');
                $responseService->setDatatable($datatable);
                $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();

                $qb = $datatableQueryBuilder->getQb();
                $qb->select('userId.lastname, userId.firstname, userId.telephone, MAX(rdv.creneauxDebut) as creneauxDebut, MAX(rdv.creneauxFin) as creneauxFin')
                        ->andWhere("rdv.proId = :proId")
                        ->andWhere("rdv.userId IS NOT NULL")
                        ->groupBy('rdv.userId')
                        ->setParameter('proId', $id);

                return $responseService->getResponse();
            }

            return $this->render('RdvBundle:RdvUserList:index.html.twig', array(
                'datatable' => $datatable,
            ));
        } else {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }

}
