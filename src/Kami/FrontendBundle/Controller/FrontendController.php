<?php

namespace Kami\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FrontendController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('@KamiFrontend/Default/index.html.twig');
    }

    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return $this->render('@KamiFrontend/Default/admin.html.twig');
    }
}
