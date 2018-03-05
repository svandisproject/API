<?php

namespace Kami\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class FrontendController extends Controller
{
    /**
     * @Route("/app{slash}{any}", requirements={"any":"(.+)?", "slash":"\/?"})
     */
    public function userAction()
    {
        return $this->render('@KamiFrontend/Default/index.html.twig');
    }

    /**
     * @Route("/admin{slash}{any}", requirements={"any":"(.+)?", "slash":"\/?"})
     */
    public function adminAction()
    {
        return $this->render('@KamiFrontend/Default/admin.html.twig');
    }
}
