<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;

    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // L'objectif est de créer 10 séries qui appartiendront à une catégorie au hasard
            for($i = 1; $i <= 10; $i++) {
                $program = new Program();
                $program->setTitle($faker->words(3, true));
                $program->setSynopsis($faker->paragraphs(2, true));
                $program->setCategory($this->getReference('category_' . $faker->numberBetween(1, 5)));
                $program->setPoster('../images/'.$i. '.jpeg');
                $slug = $this->slugger->slug($program->getTitle());
                $program->setSlug($slug);
                $manager->persist($program);
                $this->addReference('program_' . $i, $program);
            }        
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }
}
