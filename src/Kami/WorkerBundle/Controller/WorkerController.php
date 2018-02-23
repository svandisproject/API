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
        $secret = $this->get('craue_config')->get('worker.secret');

        if ($secret !== $request->get('secret')) {
            throw new AccessDeniedHttpException('Worker secret is incorrect');
        }

        $factory = new Factory;
        $generator = $factory->getGenerator(new Strength(Strength::MEDIUM));

        $secret = $generator->generateString(128, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

        $worker = new Worker();
        $worker
            ->setHost($request->getClientIp())
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
        return new JsonResponse(['secret'=>$this->get('craue_config')->get('worker.secret')]);
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

        return new JsonResponse(['host'=>$worker->getHost()]);
    }
}
