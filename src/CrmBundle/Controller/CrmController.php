<?php

namespace CrmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CrmController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {
        return $this->render('CrmBundle:Default:index.html.twig');
    }
}
