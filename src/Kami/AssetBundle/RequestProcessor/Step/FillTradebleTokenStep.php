<?php


namespace Kami\AssetBundle\RequestProcessor\Step;


use Cassandra\SimpleStatement;
use Kami\AssetBundle\Entity\Asset;
use Kami\IcoBundle\Entity\Industry;
use M6Web\Bundle\CassandraBundle\Cassandra\Client as CassandraClient;
use Kami\AssetBundle\Model\TradableToken;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Symfony\Component\HttpFoundation\Request;

class FillTradebleTokenStep extends AbstractStep
{
    /**
     * @var CassandraClient
     */
    private $client;

    private $endOfLastYear;
    private $startOfCurrentYear;
    private $endOfLastWeek;
    private $startOfCurrentWeek;
    private $yesterday;
    private $today;

    public function __construct(CassandraClient $client)
    {
        $this->client = $client;

        $this->endOfLastYear = (new \DateTime('@'.strtotime(date('Y') - 1 . '-12-31 23:55')))
            ->format('Y-m-d H-i');
        $this->startOfCurrentYear = (new \DateTime('@'.strtotime(date('Y') . '-01-01 00:00')))
            ->format('Y-m-d H-i');
        $this->endOfLastWeek = (new \DateTime('@'.strtotime(date("Y-m-d",strtotime("last sunday")) . ' 23:55')))
            ->format('Y-m-d H-i');
        $this->startOfCurrentWeek = (new \DateTime('@'.strtotime(date("Y-m-d",strtotime("last Monday", strtotime('tomorrow'))) . ' 00:00')))
            ->format('Y-m-d H-i');
        $this->yesterday = (new \DateTime('@'.strtotime(date("Y-m-d", time() - 60 * 60 * 24) . ' 23:55')))
            ->format('Y-m-d H-i');
        $this->today = (new \DateTime('@'.strtotime(date("Y-m-d", time()) . ' 00:00')))
            ->format('Y-m-d H-i');
    }

    /**
     * @param Request $request
     * @return ArtifactCollection
     * @throws \Cassandra\Exception
     * @throws \Kami\Component\RequestProcessor\ProcessingException
     */
    public function execute(Request $request): ArtifactCollection
    {
        $tokens = [];
        $assets = $this->getArtifact('response_data')->getContent();
        foreach ($assets as $asset){
            $token = new TradableToken();
            $token->setTicker($asset->getTicker());
            $token->setPrice($asset->getPrice());
            $asset->getTitle() ? $token->setTitle($asset->getTitle()) : $token->setTitle($asset->getTicker());

            if($ico = $asset->getIco()){
                if($industries = $ico->getIndustries()){
                    foreach ($industries as $industry){
                        $token->setIndustry($industry);
                    }
                }
            }elseif(!$ico || !$ico->getIndustries()){
                $token->setIndustry((new Industry())->setTitle('Blockchain'));
            }

            if($marketCap = $asset->getMarketCap()){
                $token->setMarketCap($marketCap->getCirculatingSupply() * $asset->getPrice());
                $token->setVolume($marketCap->getVolume24());
            }

            $token->setChange($this->setChanges($asset, $this->yesterday, $this->today));
            $token->setWeeklyChange($this->setChanges($asset, $this->endOfLastWeek, $this->startOfCurrentWeek));
            $token->setYearToDayChange($this->setChanges($asset, $this->endOfLastYear, $this->startOfCurrentYear));
            array_push($tokens, $token);
        }
        $this->getArtifact('response_data')->setContent($tokens);

        return new ArtifactCollection();
    }

    public function getRequiredArtifacts() : array
    {
        return ['response_data'];
    }

    /**
     * @param Asset $asset
     * @param $from
     * @param $to
     * @return null|string
     * @throws \Cassandra\Exception
     */
    private function setChanges($asset, $from, $to)
    {
        $ticker = $asset->getTicker();
        $cassandra = $this->client;
        $query = "SELECT volume, price, ticker, max(time) ".
            "from svandis_asset_prices.average_price ".
            "WHERE ticker = '$ticker' AND ".
            "time > '$from' AND ".
            "time < '$to' ".
            "ALLOW FILTERING";
        $statement = new SimpleStatement($query);
        $result = $cassandra->execute($statement);
        if($result[0]['price'] != null){
            return $this->getChange($asset->getPrice(), $result[0]['price']->value());
        } else {
            return null;
        }
    }

    private function getChange($price, $lastPrice)
    {
        if($price > $lastPrice){
            $result = ((($price * 100) / $lastPrice) - 100);
        } else {
            $result = - ((($lastPrice * 100) / $price) - 100);
        }
        return $result;
    }

}