<?php

namespace RdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RdvBundle:Default:index.html.twig');
    }

    public function testLayout(){
        return $this->render('@Rdv/Default/dashboard.twig');
    }
}
