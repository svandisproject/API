<?php


namespace Kami\ContentBundle\RequestProcessor\Step;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class FetchLikeByPostIdStep extends AbstractStep
{
    /**
     * @var Registry
     */
    protected $doctrine;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    public function __construct(Registry $doctrine, TokenStorageInterface $tokenStorage){
        $this->doctrine = $doctrine;
        $this->tokenStorage = $tokenStorage;
    }

    public function execute(Request $request) : ArtifactCollection
    {
        /** @var \ReflectionClass $reflection */
        $reflection = $this->getArtifact('reflection');
        $entity = $this->doctrine->getRepository($reflection->getName())->findOneBy(['post' => $request->get('id'),
            'user' => $this->tokenStorage->getToken()->getUser()]);

        if (!$entity) {
            throw new NotFoundHttpException('Resource not found');
        }

        return new ArtifactCollection([
            new Artifact('entity', $entity)
        ]);
    }

    public function getRequiredArtifacts() : array
    {
        return ['reflection', 'access_granted'];
    }

}