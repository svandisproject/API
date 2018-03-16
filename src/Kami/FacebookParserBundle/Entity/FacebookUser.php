<?php

namespace Kami\FacebookParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;
use JMS\Serializer\Annotation as JMS;

/**
 * FacebookUser
 *
 * @ORM\Table(name="facebook_user")
 * @ORM\Entity(repositoryClass="Kami\FacebookParserBundle\Repository\FacebookUserRepository")
 * @Api\Access({"ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeEditedBy({"ROLE_ADMIN"})
 * @JMS\ExclusionPolicy("all")
 */
class FacebookUser
{
    /**
     * @var int
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @JMS\Expose
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @JMS\Expose(if="service('kami_api_core.access_manager').canAccessProperty(object, context, property_metadata)")
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @JMS\Expose(if="service('kami_api_core.access_manager').canAccessProperty(object, context, property_metadata)")
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return FacebookUser
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return FacebookUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
