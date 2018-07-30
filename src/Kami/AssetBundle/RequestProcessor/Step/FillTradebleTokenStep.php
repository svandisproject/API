<?php


namespace Kami\AssetBundle\RequestProcessor\Step;

use Kami\IcoBundle\Entity\Industry;
use Kami\StockBundle\ChangesHelper\ChangesHelper;
use Kami\AssetBundle\Model\TradableToken;
use Kami\Component\RequestProcessor\ArtifactCollection;
use Kami\Component\RequestProcessor\Step\AbstractStep;
use Symfony\Component\HttpFoundation\Request;

class FillTradebleTokenStep extends AbstractStep
{
    /**
     * @var ChangesHelper
     */
    private $changesHelper;

    public function __construct(ChangesHelper $changesHelper)
    {
        $this->changesHelper = $changesHelper;
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

            $token->setChange($this->changesHelper->setChanges($asset, 'day'));
            $token->setWeeklyChange($this->changesHelper->setChanges($asset, 'week'));
            $token->setYearToDayChange($this->changesHelper->setChanges($asset, 'year'));
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