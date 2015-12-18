<?php

namespace PitchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PitchBundle\Entity\Comment;
use PitchBundle\Entity\Pitch;
use UserBundle\Entity\User;

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
        $pitch->setTitle("pitch 1");
        $pitch->setDescription("desc1");

        $category = $manager->getRepository("PitchBundle:Category")->findOneBy(array());
        $pitch->setCategory($category);

        $user = new User();
        $user->setUsername('alessio');
        $user->setPassword('123');
        $user->setEmail('alessio@123.fr');

        foreach ($comments as $c) {
            $comment = new Comment();
            $comment->setText($c);
            $comment->setPitch($pitch);
            $pitch->addComment($comment);

        }
        $pitch->setUser($user);
        $user->addPitch($pitch);

        $manager->persist($user);
        $manager->flush();
    }
}
