<?php

namespace RdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ValidationAdminController extends Controller
{
   
    public function indexAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();

        // Get your Datatable ...
        //$datatable = $this->get('app.datatable.post');
        //$datatable->buildDatatable();

        // or use the DatatableFactory
        /** @var DatatableInterface $datatable */
        $datatable = $this->get('rdv.datatable.user');
        $datatable->buildDatatable();

        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($datatable);
            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
            
            $qb = $datatableQueryBuilder->getQb();
            $qb->andWhere('user.validationAdmin = false');

            return $responseService->getResponse();
        }

        return $this->render('RdvBundle:ValidationAdmin:index.html.twig', array(
            'datatable' => $datatable,
        ));
    }
    
    public function validationAction(Request $request, $id)
    {
        $this->getDoctrine()->getManager()->getRepository('RdvBundle:User')->validateUser( $id );
        return new \Symfony\Component\HttpFoundation\JsonResponse([]);
    }
}
