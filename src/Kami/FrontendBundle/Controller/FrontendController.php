<?php

namespace Kami\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class FrontendController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        sleep(3);
        return $this->render('@KamiFrontend/Default/index.html.twig');
    }

    /**
     * @Route("/admin{slash}{any}", requirements={"any":"(\w+)?", "slash":"\/?"})
     */
    public function adminAction()
    {
        return $this->render('@KamiFrontend/Default/admin.html.twig');
    }
}
