<?php


namespace Kami\StockBundle\Watcher\History;

use Cassandra\BatchStatement;
use Cassandra\Exception\ExecutionException;
use Cassandra\Timeuuid;
use Cassandra\Uuid;
use Exception;
use Kami\AssetBundle\Entity\Asset;

class HistoryExchangeVolumesWatcher extends AbstractHistoryVolumesWatcher
{

    /**
     * @var array
     */
    private $historyDataAsset = [];

    /**
     * @var array
     */
    private $wrongTitle = [
        'CHAT' => 'chatcoin',
        'XRA' => 'ratecoin',
        'BRX' => 'breakout-stake',
        'GAM' => 'gambit',
        'INCNT' => 'incent',
        'IPL' => 'insurepal',
        'DDF' => 'digital-developers-fund',
        'XRP' =>	'ripple',
        'Bytecoin' => 'bytecoin-bcn',
        'Golem' => 'golem-network-tokens',
        'IOST' => 'iostoken',
        'Nebulas' => 'nebulas-token',
        'MCO' => 'monaco',
        'Metaverse ETP' => 'metaverse',
        'Polymath' => 'polymath-network',
        'KickCoin' => 'kickico',
        'Byteball Bytes' => 'byteball',
        'Scry.info' => 'scryinfo',
        'Game.com'=> 'game',
        'Santiment Network Token' => 'santiment',
        'iExec RLC' => 'rlc',
        'CRYPTO20' => 'c20',
        'BCC' => 'bitconnect',
        'Po.et' => 'poet',
        'Ambrosus' => 'amber',
        'DSH' => 'dashcoin',
        'SPK' => 'sparks',
        'NavCoin' => 'nav-coin',
        'AdEx' => 'adx-net',
        'QLC Chain' => 'qlink',
        'Agrello' => 'agrello-delta',
        'SEN' => 'consensus',
        'CTX' => 'cartaxi-token',
        'ESS' => 'essentia',
        'eBoost' => 'eboostcoin',
        'ERC' => 'europecoin',
        'DopeCoin' => 'dopecoin',
        'BYC' => 'bytecent',
        'XMG' => 'magi',
        'GBG' => 'golos-gold',
        'U.CASH' => 'ucash',
        'United Traders Token' => 'uttoken',
        'LGO Exchange' => 'legolas-exchange',
        'LBRY Credits' => 'library-credit',
        'Bloom' => 'bloomtoken',
        'Matchpool' => 'guppy',
        'I/O Coin' => 'iocoin',
        'BitTube' => 'bit-tube',
        'ATMChain' => 'attention-token-of-media',
        'Kore' => 'korecoin',
        'Memetic / PepeCoin' => 'memetic',
        'Hydro' => 'hydrogen',
        'Spectre.ai Dividend Token' => 'spectre-dividend',
        'MediBloc [ERC20]' => 'medx',
        'DecentBet' => 'decent-bet',
        'ECC' => 'eccoin',
        'Effect.AI' => 'effect-ai',
        'BlockMason Credit Protocol' => 'blockmason',
        'TraDove B2BCoin' => 'b2bcoin',
        'MARK.SPACE' => 'mark-space',
        'HTMLCOIN' => 'html-coin',
        'Grid+' => 'grid',
        'AI Doctor' => 'aidoc',
        'Russian Miner Coin' => 'russian-mining-coin',
        'LockTrip' => 'lockchain',
        'Electrify.Asia' => 'electrifyasia',
        'IXT' => 'ixledger',
        'Gems' => 'gems-protocol',
        'Medicalchain' => 'medical-chain',
        'LocalCoinSwa' => 'local-coin-swap',
        'Friendz' => 'friends',
        'Pandacoin' => 'pandacoin-pnd',
        'Primalbase Token' => 'primalbase',
        'MediBloc [QRC20]' => 'medibloc',
        'Debitum' => 'debitum-network',
        'WeTrust' => 'trust',
        'Elite' => '1337coin',
        'DAO.Casino' => 'dao-casino',
        'Jury.Online Token' => 'jury-online-token',
        'HEAT' => 'heat-ledger',
        'Bela' => 'belacoin',
        'Spectiv' => 'signal-token',
        'Blue Protocol'	=> 'ethereum-blue',
        'TEAM (TokenStars)' => 	'tokenstars',
        'EncryptoTel [WAVES]' => 'encryptotel',
        '0xBitcoin' => '0xbtc',
        'Spectre.ai Utility Token' => 'spectre-utility',
        'Truegame' => 'tgame',
        'On.Live' => 'on-live',
        'Bob\'s Repair' => 'bobs-repair',
        'ACE (TokenStars)' => 'ace',
        'eBitcoin' => 'ebtcnew',
        'Miners\' Reward Token' => 'miners-reward-token',
        'Stellar Holdings' => 'interstellar-holdings',
        'DCORP Utility' => 'drp-utility',
        'Monoeci' => 'monacocoin',
        'MAZA' => 'mazacoin',
        'bitJob' => 'student-coin',
        'WCOIN' => 'wawllet',
        'Peerguess' => 'guess',
        'LocalCoinSwap' => 'local-coin-swap',
        'Cofound.it' => 'cofound-it',
        'SoMee.Social' => 'ongsocial'
    ];

    public function updateVolumes()
    {
        $assets = $this->getAssets();
        foreach ($assets as $asset) {
            $arr = $this->getRemoteData($asset);
            if(is_array($arr)) $this->persistHistoryVolumes($this->normalizeRemoteData($arr));
        }

    }

    /**
     * @return array
     */
    private function getAssets () {
       return $this->entityManager->getRepository(Asset::class)->findAll();
    }

    /**
     * @param  Asset $asset
     *
     * @return array
     */
    private function getRemoteData ($asset)
    {
            $this->historyDataAsset = [];
        if (array_key_exists($asset->getTitle(), $this->wrongTitle)) {
            $title = $this->wrongTitle[$asset->getTitle()];
        } elseif (array_key_exists($asset->getTicker(), $this->wrongTitle)) {
            $title = $this->wrongTitle[$asset->getTicker()];
        } elseif ($asset->getTitle() == null) {
            $title = strtolower($asset->getTicker());
        } else {
            $title = str_replace(' ', '-', strtolower(trim($asset->getTitle())));
        }
        try {
            $response = $this->httpClient->get('https://graphs2.coinmarketcap.com/currencies/'.$title);
            $body = $response->getBody();

            $data = json_decode($body, true);

            $this->historyDataAsset[$asset->getTicker()] = [
                'available_supply' => $data['market_cap_by_available_supply'],
                'price_usd' => $data['price_usd'],
                'volume_usd' => $data['volume_usd']
            ];

            return $this->historyDataAsset;
        } catch ( Exception $e) {

        }
    }

    /**
     * @param array $historyData
     *
     * @return void
     */
    private function persistHistoryVolumes ($historyData)
    {
        foreach ($historyData as $symbol => $itemData) {
            $ticker = strtolower(str_replace(" ", "_", trim($symbol)));
            if ($this->redis->get('price_'.$symbol) && $this->redis->get('avg_price_' . $ticker)) {
                echo "Start persist history data for" . $symbol. " !!!\n";
                foreach ($itemData as $value) {
                    if ($value['price'] != null) {
                            try {
                                $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);
                                $prepared = $this->client->prepare(
                                    'INSERT INTO svandis_asset_prices.avg_price_'.$ticker.' (id, price, volume, time) 
                                    VALUES (?, ?, ?, toTimestamp('.new Timeuuid(intval($value['time'])).'));'
                                );
                                $batch->add(
                                    $prepared,
                                    [
                                        'id' => new Uuid(\Ramsey\Uuid\Uuid::uuid1()->toString()),
                                        'price' => new \Cassandra\Float(floatval($value['price'])),
                                        'volume' => new \Cassandra\Float(floatval($value['volume']))
                                    ]
                                );
                                $this->client->execute($batch);
                                $this->redis->set('history_for_'.$ticker, $symbol);
                            } catch (ExecutionException $exception) {
                                echo $exception->getMessage();
                            }
                    }
                }
                echo "Done for " . $symbol . " !!!\n";
            }
        }
    }

    /**
     * @param array $remoteData
     *
     * @return array
     */
    private function normalizeRemoteData ($remoteData)
    {
        $all = [];

        foreach ($remoteData as $ticker => $remoteHistoryData) {
            echo "Normalize " . $ticker . "\n";
            $all[$ticker] = [];
            $volume = $remoteHistoryData['volume_usd'];
            $price = $remoteHistoryData['price_usd'];
            foreach ($price as $data) {
                $historyTimePrice = $data[0];
                $historyPrice = $data[1];
                foreach ($volume as $mata) {
                    $historyTimeVolume = $mata[0];
                    $historyVolume = $mata[1];
                    if ($historyTimePrice == $historyTimeVolume) {
                        array_push(
                            $all[$ticker],
                            ['time' => $historyTimeVolume, 'price' => $historyPrice, 'volume' => $historyVolume]
                        );
                    }
                }
            }
        }
        return $all;
    }

}