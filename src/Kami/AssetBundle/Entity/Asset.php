<?php

namespace Kami\AssetBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kami\ContentBundle\Entity\Post;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Kami\ApiCoreBundle\Annotation as Api;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Asset
 *
 * @ORM\Entity(repositoryClass="Kami\AssetBundle\Repository\AssetRepository")
 * @ORM\Table(name="asset")
 */
class Asset
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
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="ticker", type="string", length=10)
     * @Assert\NotBlank()
     */
    private $ticker;

    /**
     * @ORM\Column(name="ticker", type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Kami\AssetBundle\Entity\TokenType")
     */
    private $tokenType;

    /**
     * @ORM\ManyToMany(targetEntity="Kami\ContentBundle\Entity\Post", inversedBy="assets")
     * @ORM\JoinTable(name="asset_posts")
     */
    private $posts;

}
