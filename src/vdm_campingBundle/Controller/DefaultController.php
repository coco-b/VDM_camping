<?php

namespace vdm_campingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('vdm_campingBundle:Default:index.html.twig');
    }
}
