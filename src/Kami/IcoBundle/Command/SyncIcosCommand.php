<?php


namespace Kami\IcoBundle\Command;


use Doctrine\ORM\EntityManager;
use GuzzleHttp\Promise\EachPromise;
use Kami\AssetBundle\Entity\Asset;
use Kami\IcoBench\Client;
use Kami\IcoBundle\Entity\Ico;
use Kami\IcoBundle\Normalizer\IcoBench\IcoBenchNormalizer;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncIcosCommand extends Command
{
    /**
     * @var EntityManager
     */
    protected $manager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Client
     */
    protected $icoBenchClient;

    /**
     * @var IcoBenchNormalizer
     */
    protected $icoBenchNormalizer;

    /**
     * @var bool
     */
    private $emergency = false;

    public function __construct(Client $icoBenchClient,
                                IcoBenchNormalizer $icoBenchNormalizer,
                                EntityManager $manager,
                                LoggerInterface $logger)
    {
        $this->icoBenchClient = $icoBenchClient;
        $this->icoBenchNormalizer = $icoBenchNormalizer;
        $this->manager = $manager;
        $this->logger = $logger;

        parent::__construct();
    }


    protected function configure()
    {
        $this->setName('svandis:icos:sync')
            ->setDescription('Sync ICOs with remote sources');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Kami\IcoBench\Exception\IcoBenchException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        while (!$this->emergency) {
            $hour = date('H');
//            if($hour == 23){
                $totalPages =  $this->icoBenchClient->getIcos('all', [], false)['pages'];

                for($i = 0; $i < $totalPages; $i++) {
                    $output->writeln('Processing Page: '.$i.' from '.$totalPages);

                    $response = $this->icoBenchClient->getIcos('all', ['page'=> $i]);
                    foreach ($response['results'] as $result) {
                        $promises = (function () use ($result) {
                            yield $this->icoBenchClient->getIco($result['id']);
                        })();

                        (new EachPromise($promises, [
                            'concurrency' => 10,
                            'fulfilled' => function ($res) use ($result, $output) {
                                $ico = $this->findOrCreateIco($result['id']);
                                $asset = $this->findOrCreateAsset($res['finance']['token']);
                                $ico = $this->icoBenchNormalizer->normalize($ico, $res, $asset);

                                $this->manager->persist($ico);
                                $this->manager->flush();
                                $output->writeln('Successfully updated ICO '.$ico->getTitle());

                            },
                            'rejected' => function ($reason, $index) {
                                $this->logger->error('Could\'t get history volumes for ' . $index );
                            }
                        ]))->promise()->wait();
                    }
                }

                $output->writeln('Successfully updated ICOs');
//            } else sleep(3600);
        }
    }

    /**
     * @param int $remoteId
     *
     * @return Ico
     *
     * @throws \Doctrine\ORM\ORMException
     */
    protected function findOrCreateIco(int $remoteId) : Ico
    {
        if(!$ico = $this->manager->getRepository('KamiIcoBundle:Ico')
            ->findOneBy(['remoteId' => $remoteId])) {
            $ico = new Ico();
        }
        return $ico;
    }

    /**
     * @param string $ticker
     *
     * @return Asset
     */
    protected function findOrCreateAsset($ticker): Asset
    {
        if (!$asset = $this->manager->getRepository('KamiAssetBundle:Asset')
            ->findOneBy(['ticker' => $ticker])
        ) {
            $asset = new Asset();
            $asset->setTicker($ticker);
            $this->manager->persist($asset);
        }
        return $asset;
    }
}