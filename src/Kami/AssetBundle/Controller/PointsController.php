<?php


namespace Kami\AssetBundle\Controller;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class PointsController extends Controller
{

    /**
     * @param string $ticker
     * @return Response
     * @Route("/api/points/{ticker}", methods={"GET"})
     */
    public function getPoints($ticker)
    {
        $preparedTicker = strtolower(trim($ticker));
        try {
            $data = file_get_contents(__DIR__ . '/../Points/' . $preparedTicker . '.txt');
        } catch (\Exception $exception) {
            throw new BadRequestHttpException('There is not any points for this ticker ' . $ticker);
        }
        $newArr = explode(',', $data);

         dump($newArr); die;
//         dump( json_encode([$data])); die;

        return new Response(json_encode([$data]));

    }


}