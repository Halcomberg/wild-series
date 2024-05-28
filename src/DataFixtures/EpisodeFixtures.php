<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $episode1 = new Episode();
        $episode1->setTitle('Welcome to the Playground');
        $episode1->setNumber(1);
        $episode1->setSynopsis("Orphaned sisters Vi and Powder bring trouble to Zaun's underground streets in the wake of a heist in posh Piltover.");
        $episode1->setSeason($this->getReference('season1_Arcane'));
        // ajouter les autres propriétés...
        $manager->persist($episode1);

        $episode2 = new Episode();
        $episode2->setTitle('Some Mysteries Are Better Left Unsolved');
        $episode2->setNumber(2);
        $episode2->setSynopsis("
        L'inventeur idéaliste Jayce tente d'exploiter la magie grâce à la science, malgré l'avertissement de son mentor. Le chef du crime, Silco, teste une substance puissante.");
        $episode2->setSeason($this->getReference('season1_Arcane'));
        // ajouter les autres propriétés...
        $manager->persist($episode2);

        $episode3 = new Episode();
        $episode3->setTitle('The Base Violence Necessary for Change');
        $episode3->setNumber(3);
        $episode3->setSynopsis("Une confrontation épique entre d'anciens rivaux aboutit à un moment fatidique pour Zaun. Jayce et Viktor risquent tout pour leurs recherches.");
        $episode3->setSeason($this->getReference('season1_Arcane'));
        // ajouter les autres propriétés...
        $manager->persist($episode3);

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
            ProgramFixtures::class,
        ];
    }
}
