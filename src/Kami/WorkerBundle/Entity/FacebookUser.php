<?php

namespace Kami\WorkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kami\ApiCoreBundle\Annotation as Api;

/**
 * FacebookUser
 *
 * @ORM\Table(name="facebook_user")
 * @ORM\Entity(repositoryClass="Kami\WorkerBundle\Repository\FacebookUserRepository")
 * @Api\Access({"ROLE_ADMIN"})
 * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
 * @Api\CanBeEditedBy({"ROLE_ADMIN"})
 */
class FacebookUser
{
    /**
     * @var int
     *
     * @Api\Access({"ROLE_ADMIN"})
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
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="timeInterval", type="integer")
     * @Api\Access({"ROLE_ADMIN"})
     * @Api\CanBeEditedBy({"ROLE_ADMIN"})
     * @Api\CanBeCreatedBy({"ROLE_ADMIN"})
     */
    private $timeInterval;


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

    /**
     * Set timeInterval.
     *
     * @param string $timeInterval
     *
     * @return FacebookUser
     */
    public function setTimeInterval($timeInterval)
    {
        $this->timeInterval = $timeInterval;

        return $this;
    }

    /**
     * Get timeInterval.
     *
     * @return int
     */
    public function getTimeInterval()
    {
        return $this->timeInterval;
    }
}
