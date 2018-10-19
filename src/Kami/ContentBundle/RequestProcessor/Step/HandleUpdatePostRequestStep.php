<?php


namespace Kami\ContentBundle\RequestProcessor\Step;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Kami\ApiCoreBundle\RequestProcessor\Step\Common\HandleRequestStep;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\ContentBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class HandleUpdatePostRequestStep extends HandleRequestStep
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
        $userRoles = $this->tokenStorage->getToken()->getUser()->getRoles();

        if(isset($request->request->get('post')['tags']) && in_array("ROLE_ADMIN", $userRoles) === false) {

            $existingTagIds = [];

            /** @var array */
            $newTagIds = $request->get('post')['tags'];
            $originalPostData = $this->doctrine->getRepository(Post::class)->findOneBy(['id' => $request->get('id')]);

            foreach ($originalPostData->getTags() as $tag) {
                $existingTagIds[] = $tag->getId();
            }
           if (!empty(array_diff($existingTagIds, $newTagIds))) {
                throw new AccessDeniedHttpException('You do not have access to remove tags from post' );
           };
        }

        return parent::execute($request);
    }

    public function getRequiredArtifacts() : array
    {
        return ['form', 'access_granted'];
    }

}