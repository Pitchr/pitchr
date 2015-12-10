<?php

namespace PitchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PitchBundle\Entity\Comment;
use PitchBundle\Entity\Pitch;


class LoadPitch implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $comments = array(
            'Commentaire 1',
            'Commentaire 2',
            'Commentaire 3',
            'Commentaire 4',
            'Commentaire 5'
        );

        $pitch = new Pitch();
        $pitch->setTitle("pitch1");
        $pitch->setDescription("desc1");
        $pitch->setUrl("url1");

        $category = $manager->getRepository("PitchBundle:Category")->findOneBy(array());
        $pitch->setCategory($category);

        foreach ($comments as $c) {
            $comment = new Comment();
            $comment->setText($c);
            $comment->setPitch($pitch);
            $pitch->addComment($comment);

        }
        $manager->persist($pitch);
        $manager->flush();
    }
}
