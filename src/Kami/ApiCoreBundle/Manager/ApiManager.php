<?php

namespace Kami\ApiCoreBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use JMS\Serializer\Serializer;
use Kami\ApiCoreBundle\Form\Factory;
use Kami\ApiCoreBundle\Security\AccessManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ApiManager
 *
 * @package Kami\ApiCoreBundle\Manager
 */
class ApiManager
{
    /**
     * @var Registry
     */
    private $doctrine;


    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var AccessManager
     */
    private $accessManager;

    /**
     * @var Factory
     */
    private $formFactory;

    /**
     * @var int
     */
    private $perPage;

    /**
     * ApiManager constructor.
     *
     * @param Registry $doctrine
     * @param AccessManager $accessManager
     * @param Factory $formFactory
     * @param Serializer $serializer
     * @param $perPage
     */
    public function __construct(Registry $doctrine,
                                AccessManager $accessManager,
                                Factory $formFactory,
                                Serializer $serializer,
                                $perPage)
    {
        $this->doctrine = $doctrine;
        $this->accessManager = $accessManager;
        $this->formFactory = $formFactory;
        $this->serializer = $serializer;
        $this->perPage = $perPage;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getIndex(Request $request)
    {
        $entity = new \ReflectionClass($request->attributes->get('_entity'));

        if (!$this->accessManager->canAccessResource($entity)) {
            throw new AccessDeniedHttpException();
        }


        $perPage = $request->query->getInt('per_page', $this->perPage);
        $currentPage = $request->query->getInt('page', 1);
        return $this->createResponse($this->buildIndexQuery($entity, $perPage, $currentPage)->getResult(), $request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getSingleResource(Request $request)
    {
        $entity = new \ReflectionClass($request->attributes->get('_entity'));

        if (!$this->accessManager->canAccessResource($entity)) {
            throw new AccessDeniedHttpException();
        }

        $entity = $this->doctrine->getManager()->getRepository($entity->getName())->find($request->get('id'));

        if(!$entity) {
            throw new NotFoundHttpException();
        }

        return $this->createResponse($entity, $request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createResource(Request $request)
    {
        $entityName = $request->attributes->get('_entity');
        $reflection = new \ReflectionClass($entityName);

        if (!$this->accessManager->canCreateResource($reflection)) {
            throw new AccessDeniedHttpException();
        }

        $entity = new $entityName;

        $form = $this->formFactory->getCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->getManager()->persist($entity);
            $this->doctrine->getManager()->flush();

            return $this->createResponse($entity, $request);
        }

        return $this->createResponse($form->getErrors(), $request,400);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function editResource(Request $request)
    {

        $entityName = $request->attributes->get('_entity');
        $reflection = new \ReflectionClass($entityName);
        if (!$this->accessManager->canEditResource($reflection)) {
            throw new AccessDeniedHttpException();
        }

        $entity = $this->doctrine->getManager()->getRepository($entityName)->find($request->get('id'));

        if(!$entity) {
            throw new NotFoundHttpException();
        }

        $form = $this->formFactory->getEditForm($entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->getManager()->persist($entity);
            $this->doctrine->getManager()->flush();

            return $this->createResponse($entity, $request);
        }

        return $this->createResponse($form->getErrors(), $request,400);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function deleteResource(Request $request)
    {
        $entityName = $request->attributes->get('_entity');
        $reflection = new \ReflectionClass($entityName);
        if (!$this->accessManager->canDeleteResource($reflection)) {
            throw new AccessDeniedHttpException();
        }

        $entity = $this->doctrine->getManager()->getRepository($entityName)->find($request->get('id'));

        if(!$entity) {
            throw new NotFoundHttpException();
        }

        $this->doctrine->getManager()->remove($entity);
        $this->doctrine->getManager()->flush();

        return $this->createResponse('', $request, 201);
    }

    /**
     * @param \ReflectionClass $entity
     * @param $perPage
     * @param $currentPage
     * @return Query
     */
    private function buildIndexQuery(\ReflectionClass $entity, $perPage, $currentPage)
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $this->doctrine->getManager()
            ->createQueryBuilder()
            ->select('e')
            ->from($entity->getName(), 'e')
            ->setMaxResults($perPage)
            ->setFirstResult($perPage*($currentPage - 1))
        ;

        return $queryBuilder->getQuery();
    }

    /**
     * @param mixed $data
     * @param Request $request
     * @param int $status
     *
     * @return Response
     */
    private function createResponse($data, Request $request, $status = 200)
    {
        $format = $request->attributes->get('_format');

        return new Response(
            $this->serializer->serialize($data, $format),
            $status,
            ['Content-type' => $this->getContentTypeByFormat($format)]
        );
    }

    /**
     * @param string $format
     * @return string
     */
    private function getContentTypeByFormat($format)
    {
        switch ($format) {
            case 'json':
                return 'application/json';
                break;
            case 'xml':
                return 'application/xml';
                break;
            default:
                return 'text/plain';
                break;
        }
    }
}