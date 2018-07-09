<?php


namespace Kami\AssetBundle\RequestProcessor\Step;


use Cassandra\SimpleStatement;
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


    public function __construct(CassandraClient $client)
    {
        $this->client = $client;
    }

    public function execute(Request $request) : ArtifactCollection
    {
        $tokens = [];
        $assets = $this->getArtifact('response_data')->getContent();
        foreach ($assets as $asset){
            $token = new TradableToken();
            $token->setTicker($asset->getTicker());
            $token->setTitle($asset->getTitle());
            $token->setPrice($asset->getPrice());

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
//            $token = $this->setChanges($token);
            array_push($tokens, $token);
        }
        $this->getArtifact('response_data')->setContent($tokens);

        return new ArtifactCollection();
    }

    public function getRequiredArtifacts() : array
    {
        return ['response_data'];
    }

    private function setChanges($token)
    {
        $cassandra = $this->client;
        $statement = new SimpleStatement('SELECT * FROM svandis_asset_prices.asset_price WHERE time = 1529884800)');
        $result = $cassandra->execute($statement);

        foreach ($result as $row) {
            dump($row);die;
        }
    }

}