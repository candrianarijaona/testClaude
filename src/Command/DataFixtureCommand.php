<?php

namespace App\Command;

use App\Entity\Clavier;
use App\Entity\Ecran;
use App\Entity\MarqueEcran;
use App\Entity\Souris;
use App\Entity\Tour;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:data-fixture',
    description: 'Add a short description for your command',
)]
class DataFixtureCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $claviers = ['Microsoft', 'HP', 'Logitech', 'Cosair'];
        $souris = ['Microsoft', 'Asus', 'Logitech', 'Cosair'];
        $tours = ['Tour PC Jeux', 'Tour PC Graphiste', 'Tour PC Standard', 'Tour PC Ultra++'];
        $marqueEcrans = ['Iiyama', 'Dell', 'Acer'];

        foreach ($claviers as $clavier) {
            $this->manager->persist((new Clavier())->setNom($clavier));
        }

        foreach ($souris as $s) {
            $this->manager->persist((new Souris())->setNom($s));
        }

        foreach ($tours as $tour) {
            $this->manager->persist((new Tour())->setNom($tour));
        }

        foreach ($marqueEcrans as $marqueEcran) {
            $this->manager->persist((new MarqueEcran())->setNom($marqueEcran));
        }

        $this->manager->flush();

        $this->createEcrans();

        return Command::SUCCESS;
    }

    protected function createEcrans() : void
    {
        $marquesEcrans = $this->manager->getRepository(MarqueEcran::class)->findAll();
        $tailles = [24, 27];

        foreach ($marquesEcrans as $marqueEcran) {
            foreach ($tailles as $taille) {
                $ecran = new Ecran();
                $ecran->setMarqueEcran($marqueEcran);
                $ecran->setTaille($taille);
                $this->manager->persist($ecran);
            }
        }

        $this->manager->flush();
    }
}
