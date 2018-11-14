<?php


namespace Kami\IcoBundle\Command;


use Doctrine\ORM\EntityManager;
use Kami\IcoBundle\Entity\Ico;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RestrCountriesRefreshCommand extends Command
{
    /**
     * @var EntityManager
     */
    protected $manager;

    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;

        parent::__construct();
    }


    protected function configure()
    {
        $this->setName('svandis:refresh_restr_countries:sync')
            ->setDescription('Refresh restricted countries');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $icos = $this->manager->getRepository(Ico::class)->findAll();
        foreach ($icos as $ico){
            $restrCountries = $ico->getRestrictedCountries();
            $correctData = [];
            foreach ($restrCountries as $restrCountry){
                if($restrCountry)
                array_push($correctData, $restrCountry);
            }
            $ico->setRestrictedCountries([]);
            $this->manager->persist($ico);
            $this->manager->flush();
            $ico->setRestrictedCountries($correctData);
            $this->manager->persist($ico);
        }
        $this->manager->flush();
    }

}