<?php

namespace Kami\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RandomLib\Factory;
use SecurityLib\Strength;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserController extends Controller
{
    /**
     * @Route("/user/regenerate_worker_code", methods={"POST"}, name="user.regenerateToken")
     */
    public function regenerateWorkerCodeAction()
    {
        $user = $this->getUser();

        $factory = new Factory;
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));
        $newToken = $generator->generateString(16, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $user->setWorkerToken($newToken);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse([
            'secret'=>$newToken
        ]);
    }
}