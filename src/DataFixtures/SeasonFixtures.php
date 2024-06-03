<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // L'objectif est de créer 10 séries qui appartiendront à une catégorie au hasard
        for ($i = 1; $i <= 10; $i++) {
            $programReference = $this->getReference('program_' . $i);
            for($j = 1; $j <= 5; $j++) {
                $season = new Season();
                $season->setNumber($j);
                $season->setYear(($faker->numberBetween(2000,2001)) + $j);
                $season->setDescription($faker->paragraph(2));
                $season->setProgram($programReference);
                $manager->persist($season);
                $this->addReference('season_' .$i. '_'. $j, $season);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}
