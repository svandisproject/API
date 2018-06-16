<?php


namespace Kami\ContentBundle\RequestProcessor\Step;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Kami\ApiCoreBundle\RequestProcessor\Step\Common\ValidateFormStep;
use Kami\Component\RequestProcessor\Artifact;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\ContentBundle\Entity\Post;
use Kami\WorkerBundle\Entity\Worker;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Url;

class ValidatePostStep extends ValidateFormStep
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

    public function execute(Request $request): ArtifactCollection
    {
        if (!$this->tokenStorage->getToken()->getUser() instanceof Worker) {
           return parent::execute($request);
        }
        /** @var Form $form */
        $form = $this->getArtifact('form');
        $url = $form->get('url')->getData();
        $validator = Validation::createValidator();
        if ($validator->validate($url, new Url())) {
            $originalPost = $this->doctrine->getRepository(Post::class)
                ->findOneBy(['url' => $url]);
            if (!$originalPost) {
               return parent::execute($request);
            }


            $post = $this->validatePost($originalPost, $form);
            return new ArtifactCollection([
                new Artifact('entity', $post),
                new Artifact('validation', true)
            ]);
        }

        return parent::execute($request);
    }

    private function validatePost(Post $originalPost, Form $receivedPost)
    {
        if ($originalPost->getCreatedBy() === $this->tokenStorage->getToken()->getUser()
            && !$originalPost->getValidatedBy()->contains($this->tokenStorage->getToken()->getUser())) {
            throw new BadRequestHttpException('Post can\'t be validated by same user');
        }
        if ($receivedPost->get('title')->isValid() &&
            $receivedPost->get('content')->isValid() &&
            $receivedPost->get('source')->isValid() &&
            $receivedPost->get('published_at')->isValid()) {

            $titleMatch = $originalPost->getTitle() === $receivedPost->get('title')->getData();
            $contentMatch = $originalPost->getContent() === $receivedPost->get('content')->getData();
            $publishedAtMatch = $originalPost->getPublishedAt() === $receivedPost->get('published_at')->getData();

            if ($titleMatch && $contentMatch && $publishedAtMatch) {
                $originalPost->addValidatedBy($this->tokenStorage->getToken()->getUser());

                return $originalPost;
            }
            return $this->updateStalePost($originalPost, $receivedPost);
        }
        throw new BadRequestHttpException('Post is not valid');
    }

    private function updateStalePost(Post $originalPost, Form $receivedPost)
    {
        $originalPost->setTitle($receivedPost->get('title')->getData());
        $originalPost->setContent($receivedPost->get('content')->getData());
        $originalPost->setPublishedAt($receivedPost->get('published_at')->getData());

        $originalPost->setValidatedBy([]);

        return $originalPost;
    }
}