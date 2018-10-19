<?php


namespace Kami\ContentBundle\RequestProcessor\Step;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Kami\ContentBundle\Entity\Like;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PersistLikeStep extends AbstractStep
{
    /**
     * @var EntityManager
     */
    protected $manager;
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    public function __construct(Registry $doctrine, TokenStorageInterface $tokenStorage)
    {
        $this->manager = $doctrine->getManager();
        $this->tokenStorage = $tokenStorage;
    }

    public function execute(Request $request) : ArtifactCollection
    {
        $entity = $this->getArtifact('entity');
        $entity->setUser($this->tokenStorage->getToken()->getUser());

        $postId = $request->request->get('like')['post'];
        $userId = $this->tokenStorage->getToken()->getUser()->getId();
        if($this->manager->getRepository(Like::class)->findOneBy([
            'user' => $userId,
            'post' => $postId
        ])){
            throw new BadRequestHttpException("Trying to duplicate like for user $userId and post $postId", null, 400);
        }

        if(true !== $this->getArtifact('validation')) {
            return new ArtifactCollection();
        }

        try {
            $this->manager->persist($entity);
            $this->manager->flush();
        } catch (\Exception $exception) {
            throw new BadRequestHttpException('Your request can not be stored', $exception);
        }

        return new ArtifactCollection([
            new Artifact('response_data', $entity),
            new Artifact('status', 200)
        ]);
    }

    public function getRequiredArtifacts() : array
    {
        return ['validation', 'entity', 'access_granted'];
    }


}