<?php

namespace Kami\WorkerBundle\Controller;

use Kami\WorkerBundle\Entity\Worker;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use RandomLib\Factory;
use SecurityLib\Strength;

class WorkerController extends Controller
{
    /**
     * @Route("/worker/register", methods={"POST"}, name="worker.register")
     */
    public function registerAction(Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository('KamiUserBundle:User')
            ->findOneBy(['workerToken'=>$request->get('secret')]);

        if (!$user) {
            throw new AccessDeniedHttpException('Worker secret is incorrect');
        }

        $factory = new Factory;
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));

        $secret = $generator->generateString(128, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

        $worker = new Worker();
        $worker
            ->setUser($user)
            ->setSecret($secret)
            ;

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($worker);
        $manager->flush();

        return new JsonResponse([
            'token'=>$worker->getSecret()
        ]);
    }

    /**
     * @Route("/worker/heartbeat", methods={"POST"}, name="worker.heartbeat")
     */
    public function heartbeatAction(Request $request)
    {
        $worker = $this->getUser();

        $worker->setLastSeenAt(new \DateTime());

        $this->getDoctrine()->getManager()->persist($worker);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(null, 204);
    }

    /**
     * @Route("/api/settings/worker/secret", methods={"GET"}, name="worker.settings.secret")
     */
    public function getWorkerSecretAction()
    {
        return new JsonResponse(['secret'=>$this->getUser()->getWorkerToken()]);
    }

    /**
     * @Route("/worker/authenticate", methods={"POST"}, name="worker.authenticate")
     */
    public function authenticateForSocketAction(Request $request)
    {
        $worker = $this->getDoctrine()->getRepository('KamiWorkerBundle:Worker')
            ->findOneBy([
                'secret' => $request->get('secret')
            ]);

        return new JsonResponse(['host'=>$worker->getUser()]);
    }

    /**
     * @Route("/api/schedule", methods={"GET"}, name="worker.schedule")
     */
    public function scheduleAction()
    {
        $tasks = $this->get('kami_worker.scheduler')->getScheduleIndex();

        return new JsonResponse($tasks);
    }

    /**
     * @Route("/api/settings/worker/regenerate_user_token", methods={"POST"}, name="worker.regenerateUserToken")
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
