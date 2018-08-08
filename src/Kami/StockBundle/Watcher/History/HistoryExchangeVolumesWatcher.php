<?php


namespace Kami\StockBundle\Watcher\History;

use Cassandra\BatchStatement;
use Cassandra\Timeuuid;
use Kami\AssetBundle\Entity\Asset;
use Symfony\Component\Config\Definition\Exception\Exception;

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
        'Gems' => 'gems-protocol',
        'Cofound.it' => 'cofound-it',
        'SoMee.Social' => 'ongsocial'
    ];

    public function updateVolumes()
    {
        $assets = $this->getAssets();
        $this->persistHistoryVolumes($this->normalizeRemoteData($this->getRemoteData($assets)));
    }

    /**
     * @return array
     */
    private function getAssets () {
       return $this->entityManager->getRepository(Asset::class)->findAll();
    }

    /**
     * @param  array $assets
     *
     * @return array
     */
    private function getRemoteData ($assets)
    {
        foreach ($assets as $asset) {

            $title = trim(str_replace(' ', '-', strtolower($asset->getTitle())), '-');

            if ($asset->getTitle() == null) {
                $title = strtolower($asset->getTicker());
            }

            try {
                $body = $this->httpClient->get('https://graphs2.coinmarketcap.com/currencies/' . $title)->getBody();
                $data = (array) json_decode($body);
                $this->historyDataAsset[$asset->getTicker()] = [
                    'available_supply' => $data['market_cap_by_available_supply'],
                    'price_usd' => $data['price_usd'],
                    'volume_usd' => $data['volume_usd']
                ];
            } catch (\Exception $exception) {
                try {
                    if (array_key_exists($asset->getTitle(), $this->wrongTitle) || array_key_exists($asset->getTicker(), $this->wrongTitle)) {
                        $title = $this->wrongTitle[$asset->getTitle()] ?: $this->wrongTitle[$asset->getTicker()];
                    }
                    $body = $this->httpClient->get('https://graphs2.coinmarketcap.com/currencies/' . $title)->getBody();
                    $data = (array) json_decode($body);
                    $this->historyDataAsset[$asset->getTicker()] = [
                        'available_supply' => $data['market_cap_by_available_supply'],
                        'price_usd' => $data['price_usd'],
                        'volume_usd' => $data['volume_usd']
                    ];
                } catch (\Exception $exception) {
                    $this->logger->error('Could\'t get remote history data for ' . $title );
                }
            }
        }
        return $this->historyDataAsset;
    }

    /**
     * @param array $historyData
     *
     * @return void
     */
    private function persistHistoryVolumes ($historyData)
    {
        try {
            foreach ($historyData as $symbol => $itemData) {
                foreach ($itemData as $value) {
                    if ($value['price'] != null) {
                        $prepared = $this->client->prepare(
                            'INSERT INTO svandis_asset_prices.average_price (price, ticker, time, volume)
                    VALUES (?, ?, toTimestamp('. new Timeuuid(intval($value['time'])) . '), ?);'
                        );
                        $batch = new BatchStatement(\Cassandra::BATCH_LOGGED);

                        $batch->add($prepared, [
                            'price' =>  new \Cassandra\Float($value['price']),
                            'ticker' => $symbol,
                            'volume' =>  new \Cassandra\Float($value['volume'])
                        ]);
                        $this->client->execute($batch);
                    }
                }
            }

        } catch (Exception $e) {
            $this->logger->error('Cant persists data to Cassandra' );
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