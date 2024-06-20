<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
//Tout d'abord nous ajoutons la classe Factory de FakerPhp
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixtures extends Fixture
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;

    }
    
    // const CATEGORIES = [
    //     'Action',
    //     'Aventure',
    //     'Animation',
    //     'Fantastique',
    //     'Horreur',
    //     'Drame',
    //     'SF',
    //     'Thriller',
    //     'Comédie'
    // ];

    public function load(ObjectManager $manager): void
    {
        //Puis ici nous demandons à la Factory de nous fournir un Faker
        $faker = Factory::create();

        /**
        * L'objet $faker que tu récupères est l'outil qui va te permettre 
        * de te générer toutes les données que tu souhaites
        */
        for ($i = 1; $i <= 10; $i++) {
            $category = new Category();
            //Ce Faker va nous permettre d'alimenter l'instance de Category que l'on souhaite ajouter en base
            $category->setName($faker->word());
            $slug = $this->slugger->slug($category->getName());
            $category->setSlug($slug);
            $manager->persist($category);
            // Ici, on crée une référence à l'objet $category sous la forme 'category_1', 'category_2'...
            $this->addReference('category_' . $i, $category);
        }

        $manager->flush();
    }
}
