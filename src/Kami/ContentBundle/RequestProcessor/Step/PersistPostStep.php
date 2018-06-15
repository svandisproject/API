<?php


namespace Kami\ContentBundle\RequestProcessor\Step;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PersistPostStep extends AbstractStep
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(Registry $doctrine, TokenStorageInterface $tokenStorage)
    {
        $this->doctrine = $doctrine;
        $this->tokenStorage = $tokenStorage;
    }

    public function execute(Request $request) : ArtifactCollection
    {
        $entity = $this->getArtifact('entity');

        if(true !== $this->getArtifact('validation')) {
            return new ArtifactCollection();
        }

        try {
            if (null === $entity->getId()) {
               $entity->setCreatedBy($this->tokenStorage->getToken()->getUser());
            }
            $this->doctrine->getManager()->persist($entity);
            $this->doctrine->getManager()->flush();
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