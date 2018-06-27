<?php

namespace Kami\WorkerBundle\Controller;

use Kami\Util\TokenGenerator;
use Kami\WorkerBundle\Entity\Worker;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class WorkerController extends Controller
{
    /**
     * @Route("/t/get", methods={"GET"})
     */
    public function tAction()
    {
        $logger = $this->get('logger');
        $logger->info('I just got the logger');die;
        $bot_api_key  = '420303509:AAGlpRSe_K_DslbJrKs4whV9r3uOM8d11eU';
        $bot_username = 'TestRomanBot';
        $hook_url = 'https://e3048a33.ngrok.io/t/hook';

        try {
            $telegram = new Telegram($bot_api_key, $bot_username);
            $result = $telegram->setWebhook($hook_url, ['certificate' => $this->container->getParameter('kernel.root_dir')]);
        } catch (TelegramException $e) {
             $e->getMessage();
        }

        return new JsonResponse([
            'result' => $result->getDescription()
        ]);
    }

    /**
     * @Route("/t/hook", methods={"GET"})
     */
    public function hookAction(Request $request)
    {
        $bot_api_key  = '420303509:AAGlpRSe_K_DslbJrKs4whV9r3uOM8d11eU';
        $bot_username = 'TestRomanBot';
        try {
            $telegram = new Telegram($bot_api_key, $bot_username);
            $telegram->handle();
        } catch (TelegramException $e) {
            // echo $e->getMessage();
        }
    }

    /**
     * @Route("/worker/register", methods={"POST"}, name="worker.register")
     */
    public function registerAction(Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository('KamiUserBundle:User')
            ->findOneBy(['workerToken' => $request->get('secret')]);

        if (!$user) {
            throw new AccessDeniedHttpException('Worker token is incorrect');
        }

        $worker = new Worker();
        $worker
            ->setUser($user)
            ->setSecret(TokenGenerator::generate(128))
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
        return new JsonResponse(['secret' => $this->getUser()->getWorkerToken()]);
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
        return new Response(
            $this
                ->get('jms_serializer')
                ->serialize($this->get('kami_worker.scheduler')->getSchedule(), 'json'),
            200,
            ['content-type' => 'application/json']
        );
    }

    /**
     * @Route("/api/settings/worker/regenerate-user-token", methods={"POST"}, name="worker.regenerate_user_token")
     */
    public function regenerateWorkerCodeAction()
    {
        $user = $this->getUser();
        $user->updateWorkerToken();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse([
            'secret' => $user->getWorkerToken()
        ]);
    }
}
