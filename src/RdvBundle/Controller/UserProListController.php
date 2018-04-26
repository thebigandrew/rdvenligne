<?php

namespace RdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserProListController extends Controller {

    public function indexAction(Request $request) {
        $isAjax = $request->isXmlHttpRequest();

        // Get your Datatable ...
        //$datatable = $this->get('app.datatable.post');
        //$datatable->buildDatatable();
        // or use the DatatableFactory
        /** @var DatatableInterface $datatable */
        $datatable = $this->get('app.datatable.userprolist');
        $datatable->buildDatatable();

        if ($isAjax) {
            $id = $this->get('security.token_storage')->getToken()->getUser()->getId();
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($datatable);
            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();

            $qb = $datatableQueryBuilder->getQb();
            $qb->andWhere("rdv.proId = '" . $id . "'")
                ->distinct('rdv.userId');

            return $responseService->getResponse();
        }

        return $this->render('RdvBundle:RdvUserList:index.html.twig', array(
                    'datatable' => $datatable,
        ));
    }

}