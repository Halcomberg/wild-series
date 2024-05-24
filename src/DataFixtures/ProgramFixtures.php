<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [
            'title' => 'The Walking Dead',
            'synopsis' => "Dans un monde apocalyptique sous l'emprise des zombies, des rescapés se rassemblent afin de lutter pour leur survie et de préserver leur humanité.",
            'category' => 'category_Horreur',
        ],
        [
            'title' => 'Black Mirror',
            'synopsis' => "Chaque épisode a un casting différent, un décor différent et une réalité différente, mais ils traitent tous de la façon dont nous vivons maintenant, et de la façon dont nous pourrions vivre dans dix minutes si nous sommes maladroits.",
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'Blacklist',
            'synopsis' => "Après s'être rendu, un brillant fugitif accepte d'aider le FBI à arrêter d'autres criminels s'il travaille avec Elizabeth Keen, une profileuse inexpérimentée.",
            'category' => 'category_Drame',
        ],
        [
            'title' => 'Suits : avocats sur mesure',
            'synopsis' => "Après avoir impressionné un grand avocat par sa vive intelligence, un étudiant décroche un poste d'assistant convoité, alors qu'il n'est même pas diplômé en droit.",
            'category' => 'category_Drame',
        ],
        [
            'title' => 'Lucifer',
            'synopsis' => "Lassé d’être le Seigneur des Enfers, le diable s’installe à Los Angeles où il ouvre un nightclub et se lie avec une policière de la brigade criminelle.",
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'Dr. House',
            'synopsis' => "Hugh Laurie incarne Gregory House, un médecin ronchon qui hait ses patients, alors même qu'il a un don pour guérir les maladies les plus étranges.",
            'category' => 'category_Drame',
        ],
        [
            'title' => 'Breaking Bad',
            'synopsis' => "Un professeur de chimie atteint d'un cancer s'associe à un ancien élève pour fabriquer et vendre de la méthamphétamine afin d'assurer l'avenir financier de sa famille.",
            'category' => 'category_Drame',
        ],
        [
            'title' => 'La casa de papel',
            'synopsis' => "Huit voleurs font une prise d'otages dans la Maison royale de la Monnaie d'Espagne, tandis qu'un génie du crime manipule la police pour mettre son plan à exécution.",
            'category' => 'category_Thriller',
        ],
        [
            'title' => 'Monk',
            'synopsis' => "Un brillant enquêteur souffrant de troubles obsessionnels compulsifs quitte ses fonctions pour devenir consultant et résoudre les affaires les plus complexes.",
            'category' => 'category_Comédie',
        ],
        [
            'title' => 'Mercredi',
            'synopsis' => "Brillante, sarcastique et un peu morte à l'intérieur, Mercredi Addams enquête sur une série de crimes tout en se faisant des amis (et des ennemis) à l'Académie Nevermore.",
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'Stranger Things',
            'synopsis' => "Quand un jeune garçon disparaît, une petite ville découvre une affaire mystérieuse, des expériences secrètes, des forces surnaturelles terrifiantes... et une fillette.",
            'category' => 'category_SF',
        ],
        [
            'title' => 'Vikings',
            'synopsis' => "Cette série réaliste s'attache aux exploits du héros Ragnar Lothbrok qui ambitionne d'étendre le pouvoir viking à la faveur d'un chef manquant de vision politique.",
            'category' => 'category_Drame',
        ],
        [
            'title' => 'Lupin',
            'synopsis' => "Inspiré par les aventures d'Arsène Lupin, le gentleman cambrioleur Assane Diop décide de venger son père d'une terrible injustice.",
            'category' => 'category_Drame',
        ],
        [
            'title' => 'Friends',
            'synopsis' => "Cette sitcom à succès suit les joyeuses mésaventures de six amis vingtenaires qui découvrent les pièges de la vie et de l'amour dans le Manhattan des années 90.",
            'category' => 'category_Comédie',
        ],
        [
            'title' => 'The Big Bang Theory',
            'synopsis' => "Deux jeunes physiciens et leurs amis geeks voient leur cercle social s'agrandir lorsqu'une actrice en herbe emménage dans l'appartement à côté du leur.",
            'category' => 'category_Comédie',
        ],
        [
            'title' => 'Peaky Blinders',
            'synopsis' => "À Birmingham, en Angleterre, l'année 1919 est marquée par les exactions de l'impitoyable Tommy Shelby, un jeune chef de la pègre ivre de son désir de domination.",
            'category' => 'category_Drame',
        ],
        [
            'title' => 'The Witcher',
            'synopsis' => "Geralt de Riv, un chasseur de monstres mutant, poursuit son destin dans un monde chaotique où les humains se révèlent souvent plus vicieux que les bêtes.",
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'The Last of Us',
            'synopsis' => "Pour Joel, la survie est une préoccupation quotidienne qu'il gère à sa manière. Mais quand son chemin croise celui d'Ellie, leur voyage à travers ce qui reste des États-Unis va mettre à rude épreuve leur humanité et leur volonté de survivre.",
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Le jeu de la dame',
            'synopsis' => "Dans les années 1950, une jeune orpheline qui révèle un talent étonnant pour les échecs s'envole vers une gloire improbable tout en se battant contre ses addictions.",
            'category' => 'category_Drame',
        ],
        [
            'title' => 'Flash',
            'synopsis' => "Dans cette comédie d'action de super-héros, un expert de la police sort du coma avec des facultés surhumaines et part en guerre contre tous ceux qui menacent sa ville.",
            'category' => 'category_Action',
        ],
        [
            'title' => 'Sweet Tooth',
            'synopsis' => "Dans un monde post-apocalyptique, une adorable créature mi-cerf, mi-garçon part à l'aventure en quête d'une famille et d'un foyer, aux côtés d'un protecteur bourru.",
            'category' => 'category_Drame',
        ],
        [
            'title' => "Avatar : Le dernier maître de l’air",
            'synopsis' => "Katara et son frère Sokka sortent le jeune Aang d'une longue hibernation et découvrent qu'il est un Avatar maître de l'air capable de vaincre la terrible nation du feu.",
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Naruto',
            'synopsis' => "Cette série animée suit les aventures de Naruto, un orphelin qui puise dans sa force intérieure et l'esprit démoniaque qui l'habite pour devenir ninja.",
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Rick et Morty',
            'synopsis' => "Rick, un chercheur brillant, emmène son petit-fils timoré Morty dans d'autres mondes et dimensions, où ils vont vivre de folles mésaventures.",
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Umbrella Academy',
            'synopsis' => "À la mort de leur père, des frères et sœurs aux pouvoirs extraordinaires découvrent des secrets de famille traumatisants et une menace terrible qui plane sur l'humanité.",
            'category' => 'category_Action',
        ]
     ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programData) {
            $program = new Program();
            $program->setTitle($programData['title']);
            $program->setSynopsis($programData['synopsis']);
            $program->setCategory($this->getReference($programData['category']));
            $manager->persist($program);
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
