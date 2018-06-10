<?php

namespace Kami\AssetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TokenType
 *
 * @ORM\Table(name="token_type")
 * @ORM\Entity(repositoryClass="Kami\AssetBundle\Repository\TokenTypeRepository")
 */
class TokenType
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="Kami\AssetBundle\Entity\Asset", mappedBy="tokenType")
     */
    private $assets;

}
