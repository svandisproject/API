<?php


namespace Kami\IcoBundle\Command;


use Doctrine\ORM\EntityManager;
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

        $totalPages =  $this->icoBenchClient->getIcos()['pages'];

        for($i = 0; $i < $totalPages; $i++) {
            $output->writeln('Processing Page: '.$i.' from '.$totalPages);

            $response = $this->icoBenchClient->getIcos('all', ['page'=> $i]);
            foreach ($response['results'] as $result) {
                $remoteData = $this->icoBenchClient->getIco($result['id']);
                $ico = $this->findOrCreateIco($result['id']);
                $ico = $this->icoBenchNormalizer->normalize($ico, $remoteData);

                $this->manager->persist($ico);
                $this->manager->flush();
                $output->writeln('Successfully updated ICO '.$ico->getTitle());
            }
        }

        $output->writeln('Successfully updated ICOs');
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
        $ico = $this->manager->getRepository('KamiIcoBundle:Ico')
            ->findOneBy(['remoteId' => $remoteId]);

        if(!$ico) {
            return new Ico();
        }

        return $ico;
    }
}