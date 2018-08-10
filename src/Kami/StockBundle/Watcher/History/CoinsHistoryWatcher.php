<?php


namespace Kami\StockBundle\Watcher\History;

use Cassandra\BatchStatement;
use Cassandra\Timeuuid;
use Cassandra\Uuid;
use Kami\AssetBundle\Entity\Asset;
use Psr\Http\Message\ResponseInterface;

class CoinsHistoryWatcher extends AbstractHistoryExchangeWatcher
{

    /**
     * @var array
     */
    private $historyDataAsset = [];

    /**
     * @var string
     */
    private $selfTicker;

    /**
     * @var array
     */
    private $wrongTitle = [
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
        'CHAT' => 'chatcoin',
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
        'DOPE' => 'dopecoin',
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
        'Gems' => 'gems-protocol',
        'Cofound.it' => 'cofound-it'
    ];

    public function syncHistory()
    {
        $assets = $this->em->getRepository(Asset::class)->findAll();
        $remoteData = $this->getRemoteData($assets);
        $this->persistHistoryPrices($remoteData);

    }

    /**
     * @param array $assets
     *
     * @return array
     */
    private function getRemoteData($assets)
    {
        foreach ($assets as $asset) {

            $title = str_replace(' ', '-', strtolower(trim($asset->getTitle())));
            if($asset->getTitle() == null){
                $title = strtolower($asset->getTicker());
            } elseif (array_key_exists($asset->getTitle(), $this->wrongTitle)) {
                $title = $this->wrongTitle[$asset->getTitle()];
            } elseif (array_key_exists($asset->getTicker(), $this->wrongTitle)) {
                $title = $this->wrongTitle[$asset->getTicker()];
            }
            try {
                $this->selfTicker = $asset->getTicker();
                $promise = $this->httpClient->getAsync('https://graphs2.coinmarketcap.com/currencies/' . $title);
                $promise->then(
                    function (ResponseInterface $res) {
                        $data = json_decode($res->getBody(), true);
                        $this->historyDataAsset[$this->selfTicker] = [
                            'available_supply' => $data['market_cap_by_available_supply'],
                            'price_usd' => $data['price_usd'],
                            'volume_usd' => $data['volume_usd']
                        ];
                    }
                );
                $promise->wait();
            } catch (\Exception $exception) {
                $this->logger->error('Could\'t get remote history data for ' . $title );
            }
        }
        return $this->historyDataAsset;
    }

    /**
     * @param array $coinsHistoryData
     *
     * @return void
     */
    private function persistHistoryPrices($coinsHistoryData): void
    {
        $cassandra = $this->client;
        foreach ($coinsHistoryData as $ticker => $remoteData) {
            foreach ($remoteData['price_usd'] as $data) {
                if ($data[1] != 0) {
                    $prepared = $cassandra->prepare(
                        'INSERT INTO svandis_asset_prices.asset_price (id, ticker, price, exchange, time)
                        VALUES (?, ?, ?, ?, toTimestamp('. new Timeuuid(intval($data[0])) . '));'
                    );
                    $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);

                    $batch->add($prepared, [
                        'id' => new Uuid(\Ramsey\Uuid\Uuid::uuid1()->toString()),
                        'ticker' => $ticker,
                        'price' =>  new \Cassandra\Float(floatval($data[1])),
                        'exchange' =>  'CoinMarketCap'
                    ]);
                    $cassandra->execute($batch);
                }
            }
        }
    }

}