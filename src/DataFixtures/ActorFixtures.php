<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
    
        // L'objectif est de créer 10 séries qui appartiendront à une catégorie au hasard

                for($i = 1; $i <= 10; $i++) {
                    $actor = new Actor();
                    $actor->setName($faker->name());
                    $actor->setBirthdate($faker->dateTimeBetween('1970-01-01', '2000-12-31'));
                    for ($j = 0; $j < 3; $j++) {
                        $programReference = $this->getReference('program_' . random_int(1, 10));
                        $actor->addProgram($programReference);
                    }
                    $manager->persist($actor);
                    $this->addReference('actor_' . $i, $actor);
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
