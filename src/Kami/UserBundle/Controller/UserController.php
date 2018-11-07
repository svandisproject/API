<?php


namespace Kami\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     * @Route("/api/user/me", methods={"GET"})
     */
    public function getMeAction(Request $request)
    {
        return new Response(
            $this->get('jms_serializer')->serialize($this->getUser(), 'json'),
            200,
            ['content-type' => 'application/json']
        );
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/api/user/check", methods={"GET"})
     */
    public function checkTokenAction(Request $request)
    {
        return new Response(
            $this->get('jms_serializer')->serialize(['result'=>$this->get('security.token_storage')->getToken()->getUser() == null], 'json'), 200
        );
    }
}
