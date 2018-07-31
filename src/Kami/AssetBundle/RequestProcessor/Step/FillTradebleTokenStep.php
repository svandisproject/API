<?php


namespace Kami\AssetBundle\RequestProcessor\Step;

use Kami\IcoBundle\Entity\Industry;
use Kami\AssetBundle\Model\TradableToken;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Predis\Client;
use Symfony\Component\HttpFoundation\Request;

class FillTradebleTokenStep extends AbstractStep
{
    private $change = 0;

    private $weeklyChange = 0;

    private $yearToDayChange = 0;

    /**
     * @var Client
     */
    private $redis;

    public function __construct(Client $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param Request $request
     * @return ArtifactCollection
     * @throws \Cassandra\Exception
     * @throws \Kami\Component\RequestProcessor\ProcessingException
     */
    public function execute(Request $request) : ArtifactCollection
    {
        $tokens = [];
        $assets = $this->getArtifact('response_data')->getContent();
        foreach ($assets as $asset){
            $token = new TradableToken();
            $token->setTicker($asset->getTicker());
            $token->setPrice($asset->getPrice());
            if ($asset->getTitle()) {
                $token->setTitle($asset->getTitle());
            }

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


            if($data = $this->redis->get($asset->getTicker())){
                $data = json_decode($data);
                $this->change = $data->change;
                $this->weeklyChange = $data->weeklyChange;
                $this->yearToDayChange = $data->yearToDayChange;
            }
            $token->setChange($this->change);
            $token->setWeeklyChange($this->weeklyChange);
            $token->setYearToDayChange($this->yearToDayChange);
            array_push($tokens, $token);
        }
        $this->getArtifact('response_data')->setContent($tokens);

        return new ArtifactCollection();
    }

    public function getRequiredArtifacts() : array
    {
        return ['response_data'];
    }

}