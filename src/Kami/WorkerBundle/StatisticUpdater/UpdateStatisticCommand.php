<?php


namespace Kami\WorkerBundle\StatisticUpdater;

use Doctrine\ORM\EntityManager;
use Kami\ContentBundle\Entity\Post;
use Kami\WorkerBundle\Entity\Stat;
use Kami\WorkerBundle\Entity\WebFeed;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateStatisticCommand extends Command
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @var bool
     */
    private $emergency = false;

    public function __construct(EntityManager $manager){

        $this->manager = $manager;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('svandis:statistic:update');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Cassandra\Exception
     * @throws \Exception
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        while (!$this->emergency) {

            $webFeeds = $this->manager->getRepository(WebFeed::class)->findAll();

            foreach ($webFeeds as $webFeed){
                $queryBuilderMain = $this->manager->getRepository(Post::class)
                    ->createQueryBuilder('e')
                    ->where('e.source LIKE :url')
                    ->setParameter('url', '%'.$webFeed->getUrl().'%');

                $queryBuilderToxic = clone $queryBuilderMain;
                $toxicPosts = $queryBuilderToxic
                    ->leftJoin('e.tags', 't')
                    ->where("t.title = 'Toxic'")
                    ->getQuery()
                    ->getResult();

                $postsAll = $queryBuilderMain->getQuery()->getResult();

                $stat = $webFeed->getStat() ?: new Stat();
                $stat->setTotalAmount(count($postsAll));
                $firstPostCreated = end($postsAll)->getCreatedAt();
                $stat->setListed($firstPostCreated);
                $daysListed = (new \DateTime())->diff($firstPostCreated)->days;
                $stat->setFrequency($daysListed ? (count($postsAll) / $daysListed) : count($postsAll));
                $stat->setToxicity(!count($toxicPosts) ? 0 : ((count($toxicPosts) / count($postsAll)) * 100));

                $webFeed->setStat($stat);
                $this->manager->persist($webFeed);
            }

            $this->manager->flush();

            sleep(2);
        }
    }
}