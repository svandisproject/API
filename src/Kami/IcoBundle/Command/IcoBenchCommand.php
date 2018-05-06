<?php


namespace Kami\IcoBundle\Command;


use function dump;
use Kami\IcoBundle\Entity\Ico;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IcoBenchCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('svandis:ico-bench-run')
            ->setDescription('ICOs analysis.')
            ->setHelp('This command allows you fetch last info about ICOs from ICOBench...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $client = $this->getContainer()->get('kami.icobench.client');
        $icoBench = $this->getContainer()->get('ico.bench');
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');

                $allIcosPages =  $client->getIcos()['pages'];

                for($i = 0; $i <= $allIcosPages-1; $i++){
                    $icos = $client->getIcos('all', ["page"=> $i]);
                    foreach ($icos['results'] as $result){

                        $remoteData = $client->getIco($result['id']);
                        dump($result['id']);
                        $ico = $this->getContainer()->get('doctrine')->getRepository('KamiIcoBundle:Ico')->findOneByRemoteId($result['id']);

                        if(!$ico) {
                            $ico = new Ico();
                        }
                        $ico = $icoBench->fromRemote($ico, $remoteData);
                        $entityManager->persist($ico);
                        $entityManager->flush();
                    }
                }

    }
}