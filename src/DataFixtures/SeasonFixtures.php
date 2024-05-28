<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
            $season1 = new Season();
            $season1->setNumber(1);
            $season1->setYear(2021);
            $season1->setDescription("Les soeurs orphelines Vi et Powder sèment le trouble dans les rues souterraines de Zaun à la suite d'un braquage dans le quartier chic de Piltover.");
            $season1->setProgram($this->getReference('program_Arcane'));
            // ajouter les autres propriétés...
            $this->addReference('season1_Arcane', $season1);
            $manager->persist($season1);

            $season2 = new Season();
            $season2->setNumber(2);
            $season2->setYear(2022);
            $season2->setDescription("Les soeurs orphelines Vi et Powder sèment le trouble dans les rues souterraines de Zaun à la suite d'un braquage dans le quartier chic de Piltover.");
            $season2->setProgram($this->getReference('program_Arcane'));
            // ajouter les autres propriétés...
            $this->addReference('season2_Arcane', $season2);
            $manager->persist($season2);

            $season3 = new Season();
            $season3->setNumber(3);
            $season3->setYear(2023);
            $season3->setDescription("Les soeurs orphelines Vi et Powder sèment le trouble dans les rues souterraines de Zaun à la suite d'un braquage dans le quartier chic de Piltover.");
            $season3->setProgram($this->getReference('program_Arcane'));
            // ajouter les autres propriétés...
            $this->addReference('season3_Arcane', $season3);
            $manager->persist($season3);

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
