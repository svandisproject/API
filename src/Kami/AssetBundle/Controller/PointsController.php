<?php


namespace Kami\AssetBundle\Controller;

use Cassandra\Exception\ExecutionException;
use Cassandra\SimpleStatement;
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

        $cassandra = $this->get('m6web_cassandra.client.default');
        $serializer = $this->get('jms_serializer');

        $rows = [];
        $preparedTicker = strtolower(str_replace(" ", "_", trim($ticker)));

        try {
            $query = "SELECT  volume, price, time FROM svandis_asset_prices.avg_price_" .
                $preparedTicker . " WHERE ticker = '$preparedTicker' ORDER BY time DESC ALLOW FILTERING";
            $statement = new SimpleStatement($query);
            $result = $cassandra->execute($statement);

        } catch (ExecutionException $exception) {
            return new Response($exception->getMessage());
        }

        foreach ($result as $row) {

            array_push($rows, [
                'time' => $row['time']->time(),
                'price' => $row['price']->value(),
                'volume' => $row['volume']->value()
            ]);
        }

        $response = $serializer->serialize($rows, 'json');
        return new Response($response);

    }


}