<?php

namespace Kami\WorkerBundle\Command;

use Craue\ConfigBundle\Entity\Setting;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use RandomLib\Factory;
use SecurityLib\Strength;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateWorkerSecretCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName('kami:worker:generate-secret');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Worker secret generator');

        try {
            $secret = $this->getContainer()->get('craue_config')->get('worker.secret');
            if ($secret) {
                $io->writeln(sprintf('<info>Current secret is: %s</info>', $secret));
                $helper = $this->getHelper('question');
                $question = new ConfirmationQuestion("Reset worker token? y/n \n", false);
                if (!$helper->ask($input, $output, $question)) {
                    return;
                }
                $this->getContainer()->get('craue_config')->set(
                    'worker.secret',
                    $this->generateNewWorkerSecret($io)
                );
            }
        } catch (\RuntimeException $e) {
            ;
            $setting = new Setting();
            $setting->setName('worker.secret');
            $setting->setValue($this->generateNewWorkerSecret($io));
            $manager = $this->getContainer()->get('doctrine')->getManager();
            $manager->persist($setting);
            $manager->flush();
        }
    }

    private function generateNewWorkerSecret($io)
    {
        $io->success(sprintf('New worker token is: %s', $secret));

        return $secret;
    }
}
