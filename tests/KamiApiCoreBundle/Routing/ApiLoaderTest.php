<?php

namespace Tests\KamiApiCoreBundle\Routing;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use JMS\Serializer\Metadata\PropertyMetadata;
use Kami\ApiCoreBundle\Annotation\Access;
use Kami\ApiCoreBundle\Annotation\AnonymousAccess;
use Kami\ApiCoreBundle\Annotation\AnonymousCreate;
use Kami\ApiCoreBundle\Annotation\AnonymousDelete;
use Kami\ApiCoreBundle\Annotation\AnonymousEdit;
use Kami\ApiCoreBundle\Annotation\CanBeCreatedBy;
use Kami\ApiCoreBundle\Annotation\CanBeDeletedBy;
use Kami\ApiCoreBundle\Annotation\CanBeEditedBy;
use Kami\ApiCoreBundle\Resources\Fixtures\Entity\MyModel;
use Kami\ApiCoreBundle\Routing\ApiLoader;
use Kami\ApiCoreBundle\Security\AccessManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ApiLoaderTest extends WebTestCase
{
// can be constructed with necessary params

    public function testCanBeConstructedWithNecessaryParams()
    {
        $apiLoader = new ApiLoader(
            [], [], 'en'
        );
        $this->assertInstanceOf(ApiLoader::class, $apiLoader);
    }

    // load

    public function testLoad()
    {
        $loader = new ApiLoader([0 => ['name' => 'my-model', 'entity' => 'Kami\ApiCoreBundle\Resources\Fixtures\Entity\MyModel']], [], 'en');
        $this->assertInstanceOf(RouteCollection::class, $loader->load(''));
    }
}