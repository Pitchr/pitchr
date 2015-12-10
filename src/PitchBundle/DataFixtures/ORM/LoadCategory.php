<?php

namespace PitchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PitchBundle\Entity\Category;
use PitchBundle\Entity\Pitch;

class LoadCategory implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $titles = array(
            'Catégorie A',
            'Catégorie B',
            'Catégorie C',
            'Catégorie D',
            'Catégorie E',
        );


        foreach ($titles as $title) {
            $category = new Category();
            $category->setTitle($title);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
