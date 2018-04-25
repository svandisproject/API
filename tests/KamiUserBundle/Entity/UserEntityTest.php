<?php

namespace Kami\UserBundle\Tests\Entity;

use function dump;
use function json_decode;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\SerializerBundle\JMSSerializerBundle;

class UserEntityTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByCategoryName()
    {

        $client = static::createClient();
        $client->request(
            'POST', '/worker/register', [
            'secret' => '1234567890123456' ]);
        $token = json_decode($client->getResponse()->getContent())->token;

        $client->request(
            'POST', '/worker/authenticate', [
            'secret' => $token ]
        );
        $host = $client->getResponse();

        dump($host); die;

    }


}