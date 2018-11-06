<?php


namespace Kami\ContentBundle\Controller;

use Kami\ApiCoreBundle\Bridge\JmsSerializer\ContextFactory\ApiContextFactory;
use Kami\ApiCoreBundle\Model\Pageable;
use Kami\ApiCoreBundle\Model\PageRequest;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LikeController extends Controller
{
    private $maxPerPage = 100;

    /**
     * @param string $period
     * @param Request $request
     * @return Response
     * @Route("/api/post/most-liked/{period}", requirements={"period":"day|week|month"}, methods={"GET"})
     */
    public function getMostLikedPostsAction($period, Request $request)
    {
        $from = date('Y-m-d H:i:s', strtotime("-1 $period" , strtotime(date('Y-m-d H:i:s'))));
        $to = date('Y-m-d H:i:s');

        $queryBuilder = $this->getDoctrine()
            ->getRepository("KamiContentBundle:Like")
            ->createQueryBuilder('l')
            ->select('l')
            ->where("l.createdAt>'$from'")
            ->andWhere("l.createdAt<'$to'")
            ->addGroupBy('l.post', 'l.id')
            ->addOrderBy('COUNT(l.post)', 'DESC');

        $perPage = $request->query->getInt('per_page', 10);
        if ($perPage > $this->maxPerPage) {
            throw new BadRequestHttpException('Max per page parameter is greater than allowed');
        }
        $currentPage = $request->query->getInt('page', 1);
        $paginator = new Pagerfanta(new DoctrineORMAdapter($queryBuilder));
        $paginator->setMaxPerPage($perPage);
        $paginator->setCurrentPage($currentPage);
        if ($currentPage < 1 || $currentPage > $paginator->getNbPages()) {
            throw new NotFoundHttpException();
        }

        $data = new Pageable(
            iterator_to_array($paginator->getIterator()),
            $paginator->getNbResults(),
            new PageRequest($currentPage, $paginator->getNbPages())
        );
        $serializer = $this->get('jms_serializer');
        $accessManager = $this->get('kami.api_core.access_manager');
        $serializer->setSerializationContextFactory(new ApiContextFactory($accessManager));
        $posts = $serializer->serialize($data, 'json');
        $response = new Response($posts);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}