<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
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
        for ($i = 1; $i <= 10; $i++) {
            $programReference = $this->getReference('program_' . $i);
            for ($j = 1; $j <= 5; $j++) {
                $seasonReference = $this->getReference('season_' .$i. '_'. $j);
                for($k = 1; $k <= 10; $k++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->words(3, true));
                    $episode->setNumber($k);
                    $episode->setSynopsis($faker->paragraphs(3, true));
                    $episode->setSeason($seasonReference);
                    $slug = $this->slugger->slug($episode->getTitle());
                    $episode->setSlug($slug);
                    $episode->setDuration($faker->numberBetween(40, 60));
                    $manager->persist($episode);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
