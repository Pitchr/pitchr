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

    foreach ($comments as $c) {
      $comment = new Comment();
      $comment->setText($c);

      $manager->persist($comment);
    }

    $manager->flush();
  }
}
