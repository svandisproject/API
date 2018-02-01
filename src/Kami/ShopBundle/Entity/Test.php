<?php

namespace Kami\ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Kami\ApiCoreBundle\Annotation as API;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="Kami\ShopBundle\Repository\TestRepository")
 * @JMS\ExclusionPolicy("all")
 * @API\AnonymousAccess
 * @API\CanBeCreatedBy({"ROLE_ADMIN"})
 * @API\CanBeEditedBy({"ROLE_ADMIN"})
 * @API\AnonymousDelete
 */
class Test
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @API\AnonymousAccess
     * @ORM\Column(name="test_1", type="string", length=255)
     * @JMS\Expose(if="service('kami_api_core.access_manager').canAccessProperty(object, context, property_metadata)")
     * @Assert\NotBlank
     */
    private $test1;

    /**
     * @var string
     *
     * @ORM\Column(name="test_2", type="string", length=255)
     * @API\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @JMS\Expose(if="service('kami_api_core.access_manager').canAccessProperty(object, context, property_metadata)")
     * @Assert\NotBlank
     */
    private $test2;

    /**
     * @var string
     *
     * @ORM\Column(name="test_3", type="string", length=255)
     * @API\Access({"ROLE_ADMIN"})
     * @JMS\Expose(if="service('kami_api_core.access_manager').canAccessProperty(object, context, property_metadata)")
     * @Assert\NotBlank
     */
    private $test3;

    /**
     * @var string
     *
     * @ORM\Column(name="test_4", type="string", length=255)
     * @API\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @JMS\Expose(if="service('kami_api_core.access_manager').canAccessProperty(object, context, property_metadata)")
     * @Assert\NotBlank
     */
    private $test4;

    /**
     * @var string
     *
     * @ORM\Column(name="test_5", type="string", length=255)
     * @API\Access({"ROLE_USER", "ROLE_ADMIN"})
     * @JMS\Expose(if="service('kami_api_core.access_manager').canAccessProperty(object, context, property_metadata)")
     * @Assert\NotBlank
     */
    private $test5;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set test1
     *
     * @param string $test1
     *
     * @return Test
     */
    public function setTest1($test1)
    {
        $this->test1 = $test1;

        return $this;
    }

    /**
     * Get test1
     *
     * @return string
     */
    public function getTest1()
    {
        return $this->test1;
    }

    /**
     * Set test2
     *
     * @param string $test2
     *
     * @return Test
     */
    public function setTest2($test2)
    {
        $this->test2 = $test2;

        return $this;
    }

    /**
     * Get test2
     *
     * @return string
     */
    public function getTest2()
    {
        return $this->test2;
    }

    /**
     * Set test3
     *
     * @param string $test3
     *
     * @return Test
     */
    public function setTest3($test3)
    {
        $this->test3 = $test3;

        return $this;
    }

    /**
     * Get test3
     *
     * @return string
     */
    public function getTest3()
    {
        return $this->test3;
    }

    /**
     * Set test4
     *
     * @param string $test4
     *
     * @return Test
     */
    public function setTest4($test4)
    {
        $this->test4 = $test4;

        return $this;
    }

    /**
     * Get test4
     *
     * @return string
     */
    public function getTest4()
    {
        return $this->test4;
    }

    /**
     * Set test5
     *
     * @param string $test5
     *
     * @return Test
     */
    public function setTest5($test5)
    {
        $this->test5 = $test5;

        return $this;
    }

    /**
     * Get test5
     *
     * @return string
     */
    public function getTest5()
    {
        return $this->test5;
    }
}

