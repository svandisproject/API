<?php


namespace Kami\ContentBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints\Url;

class UrlController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Cassandra\Exception
     * @Route("/api/post/invalidate-url", methods={"POST"})
     */
    public function invalidateUrlAction(Request $request)
    {
        $url = $request->get('url');

        if (!$this->get('validator')->validate($url, [new Url()])) {
            throw new BadRequestHttpException('URL is invalid');
        }

        $client = $this->get('m6web_cassandra.client.default');
        $hash = md5($url);


        $result = $client->execute(
            $client->prepare('select hash, confirmations from svandis_url_cache.crawled_urls where hash = ?'),
            ['arguments' => [ $hash ]]
        );

        if ($result->count() === 1) {
            $statement = $client->prepare('update svandis_url_cache.crawled_urls set confirmations = ? where hash = ?' );
            $confirmations = $result[0]['confirmations']-1;
            $client->execute($statement, ['arguments' => [new \Cassandra\Tinyint($confirmations), $hash]]);
        } else {
            $statement = $client->prepare('insert into svandis_url_cache.crawled_urls
                                          (hash, confirmations, url) values (?, ?, ?)');
            $client->execute($statement, ['arguments' => [$hash, new \Cassandra\Tinyint(-1), $url]]);
        }

        return new JsonResponse(['hash' => $hash]);

    }
}