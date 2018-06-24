<?php

namespace RdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $datatable->buildDatatable([
            'dt-type' => 'validate-pro'
        ]);

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
    
    public function invalidationAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();

        // Get your Datatable ...
        //$datatable = $this->get('app.datatable.post');
        //$datatable->buildDatatable();

        // or use the DatatableFactory
        /** @var DatatableInterface $datatable */
        $datatable = $this->get('rdv.datatable.user');
        $datatable->buildDatatable([
            'dt-type' => 'invalidate-pro'
        ]);

        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($datatable);
            $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
            
            $qb = $datatableQueryBuilder->getQb();
            $qb->andWhere('user.validationAdmin = true');
            $qb->andWhere('user.roles LIKE :role');
            $qb->setParameter('role', '%"ROLE_PRO"%');

            return $responseService->getResponse();
        }

        return $this->render('RdvBundle:ValidationAdmin:index.html.twig', array(
            'datatable' => $datatable,
        ));
    }
    
    public function validationProAction(Request $request, $id)
    {
        $this->getDoctrine()->getManager()->getRepository('RdvBundle:User')->validatePro( $id );
        return $this->redirectToRoute('rdv_validation_admin');
    }
    
    public function invalidationProAction(Request $request, $id)
    {
        $this->getDoctrine()->getManager()->getRepository('RdvBundle:User')->invalidatePro( $id );
        return $this->redirectToRoute('rdv_invalidation_admin');
    }
}
