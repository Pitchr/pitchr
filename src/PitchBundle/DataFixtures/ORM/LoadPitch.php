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
        $pitch->setTitle("Brosse a dents 2.0");
        $pitch->setDescription("Curabitur et pharetra elit, sed placerat nunc. Cras ultricies commodo lorem ac pulvinar. Phasellus porttitor maximus lacus, eget semper dolor cursus eget. Cras a pellentesque purus, nec posuere neque. Sed ligula augue, sodales in tincidunt vel, commodo ut nisl. Phasellus posuere est eget nulla sollicitudin, ac molestie justo ullamcorper. In ullamcorper, nisl nec pretium tristique, ex augue consequat nisi, non accumsan arcu est non turpis. Proin massa dui, mattis non est vitae, mollis vehicula sapien. Fusce sed nunc facilisis, dictum tellus at, rhoncus lorem. Etiam elementum varius arcu, ut tincidunt enim tempor et. Donec pulvinar nisl non enim porta, vel efficitur libero tristique. Proin euismod quam id justo iaculis cursus. Praesent sit amet leo enim. Ut malesuada pretium quam nec luctus.");
        $category = $manager->getRepository("PitchBundle:Category")->findOneBy(array());
        $pitch->setCategory($category);

        $pitch1 = new Pitch();
        $pitch1->setTitle("Ping Pong connecté");
        $pitch1->setDescription("Curabitur et pharetra elit, sed placerat nunc. Cras ultricies commodo lorem ac pulvinar. Phasellus porttitor maximus lacus, eget semper dolor cursus eget. Cras a pellentesque purus, nec posuere neque. Sed ligula augue, sodales in tincidunt vel, commodo ut nisl. Phasellus posuere est eget nulla sollicitudin, ac molestie justo ullamcorper. In ullamcorper, nisl nec pretium tristique, ex augue consequat nisi, non accumsan arcu est non turpis. Proin massa dui, mattis non est vitae, mollis vehicula sapien. Fusce sed nunc facilisis, dictum tellus at, rhoncus lorem. Etiam elementum varius arcu, ut tincidunt enim tempor et. Donec pulvinar nisl non enim porta, vel efficitur libero tristique. Proin euismod quam id justo iaculis cursus. Praesent sit amet leo enim. Ut malesuada pretium quam nec luctus.");
        $pitch1->setCategory($category);

        $pitch2 = new Pitch();
        $pitch2->setTitle("Vetements intelligents");
        $pitch2->setDescription("Curabitur et pharetra elit, sed placerat nunc. Cras ultricies commodo lorem ac pulvinar. Phasellus porttitor maximus lacus, eget semper dolor cursus eget. Cras a pellentesque purus, nec posuere neque. Sed ligula augue, sodales in tincidunt vel, commodo ut nisl. Phasellus posuere est eget nulla sollicitudin, ac molestie justo ullamcorper. In ullamcorper, nisl nec pretium tristique, ex augue consequat nisi, non accumsan arcu est non turpis. Proin massa dui, mattis non est vitae, mollis vehicula sapien. Fusce sed nunc facilisis, dictum tellus at, rhoncus lorem. Etiam elementum varius arcu, ut tincidunt enim tempor et. Donec pulvinar nisl non enim porta, vel efficitur libero tristique. Proin euismod quam id justo iaculis cursus. Praesent sit amet leo enim. Ut malesuada pretium quam nec luctus.");
        $pitch2->setCategory($category);

        $pitch3 = new Pitch();
        $pitch3->setTitle("Syra");
        $pitch3->setDescription("Curabitur et pharetra elit, sed placerat nunc. Cras ultricies commodo lorem ac pulvinar. Phasellus porttitor maximus lacus, eget semper dolor cursus eget. Cras a pellentesque purus, nec posuere neque. Sed ligula augue, sodales in tincidunt vel, commodo ut nisl. Phasellus posuere est eget nulla sollicitudin, ac molestie justo ullamcorper. In ullamcorper, nisl nec pretium tristique, ex augue consequat nisi, non accumsan arcu est non turpis. Proin massa dui, mattis non est vitae, mollis vehicula sapien. Fusce sed nunc facilisis, dictum tellus at, rhoncus lorem. Etiam elementum varius arcu, ut tincidunt enim tempor et. Donec pulvinar nisl non enim porta, vel efficitur libero tristique. Proin euismod quam id justo iaculis cursus. Praesent sit amet leo enim. Ut malesuada pretium quam nec luctus.");
        $pitch3->setCategory($category);

        $pitch4 = new Pitch();
        $pitch4->setTitle("Steam by Gabe");
        $pitch4->setDescription("Curabitur et pharetra elit, sed placerat nunc. Cras ultricies commodo lorem ac pulvinar. Phasellus porttitor maximus lacus, eget semper dolor cursus eget. Cras a pellentesque purus, nec posuere neque. Sed ligula augue, sodales in tincidunt vel, commodo ut nisl. Phasellus posuere est eget nulla sollicitudin, ac molestie justo ullamcorper. In ullamcorper, nisl nec pretium tristique, ex augue consequat nisi, non accumsan arcu est non turpis. Proin massa dui, mattis non est vitae, mollis vehicula sapien. Fusce sed nunc facilisis, dictum tellus at, rhoncus lorem. Etiam elementum varius arcu, ut tincidunt enim tempor et. Donec pulvinar nisl non enim porta, vel efficitur libero tristique. Proin euismod quam id justo iaculis cursus. Praesent sit amet leo enim. Ut malesuada pretium quam nec luctus.");
        $pitch4->setCategory($category);

        $pitch5 = new Pitch();
        $pitch5->setTitle("Nextoo Editeur");
        $pitch5->setDescription("Curabitur et pharetra elit, sed placerat nunc. Cras ultricies commodo lorem ac pulvinar. Phasellus porttitor maximus lacus, eget semper dolor cursus eget. Cras a pellentesque purus, nec posuere neque. Sed ligula augue, sodales in tincidunt vel, commodo ut nisl. Phasellus posuere est eget nulla sollicitudin, ac molestie justo ullamcorper. In ullamcorper, nisl nec pretium tristique, ex augue consequat nisi, non accumsan arcu est non turpis. Proin massa dui, mattis non est vitae, mollis vehicula sapien. Fusce sed nunc facilisis, dictum tellus at, rhoncus lorem. Etiam elementum varius arcu, ut tincidunt enim tempor et. Donec pulvinar nisl non enim porta, vel efficitur libero tristique. Proin euismod quam id justo iaculis cursus. Praesent sit amet leo enim. Ut malesuada pretium quam nec luctus.");
        $pitch5->setCategory($category);

        $pitch6 = new Pitch();
        $pitch6->setTitle("Starbuck avec smartMug");
        $pitch6->setDescription("Curabitur et pharetra elit, sed placerat nunc. Cras ultricies commodo lorem ac pulvinar. Phasellus porttitor maximus lacus, eget semper dolor cursus eget. Cras a pellentesque purus, nec posuere neque. Sed ligula augue, sodales in tincidunt vel, commodo ut nisl. Phasellus posuere est eget nulla sollicitudin, ac molestie justo ullamcorper. In ullamcorper, nisl nec pretium tristique, ex augue consequat nisi, non accumsan arcu est non turpis. Proin massa dui, mattis non est vitae, mollis vehicula sapien. Fusce sed nunc facilisis, dictum tellus at, rhoncus lorem. Etiam elementum varius arcu, ut tincidunt enim tempor et. Donec pulvinar nisl non enim porta, vel efficitur libero tristique. Proin euismod quam id justo iaculis cursus. Praesent sit amet leo enim. Ut malesuada pretium quam nec luctus.");
        $pitch6->setCategory($category);

        $pitch7 = new Pitch();
        $pitch7->setTitle("StartupWeekend");
        $pitch7->setDescription("Curabitur et pharetra elit, sed placerat nunc. Cras ultricies commodo lorem ac pulvinar. Phasellus porttitor maximus lacus, eget semper dolor cursus eget. Cras a pellentesque purus, nec posuere neque. Sed ligula augue, sodales in tincidunt vel, commodo ut nisl. Phasellus posuere est eget nulla sollicitudin, ac molestie justo ullamcorper. In ullamcorper, nisl nec pretium tristique, ex augue consequat nisi, non accumsan arcu est non turpis. Proin massa dui, mattis non est vitae, mollis vehicula sapien. Fusce sed nunc facilisis, dictum tellus at, rhoncus lorem. Etiam elementum varius arcu, ut tincidunt enim tempor et. Donec pulvinar nisl non enim porta, vel efficitur libero tristique. Proin euismod quam id justo iaculis cursus. Praesent sit amet leo enim. Ut malesuada pretium quam nec luctus.");
        $pitch7->setCategory($category);

        $pitch8 = new Pitch();
        $pitch8->setTitle("BananaPi");
        $pitch8->setDescription("Curabitur et pharetra elit, sed placerat nunc. Cras ultricies commodo lorem ac pulvinar. Phasellus porttitor maximus lacus, eget semper dolor cursus eget. Cras a pellentesque purus, nec posuere neque. Sed ligula augue, sodales in tincidunt vel, commodo ut nisl. Phasellus posuere est eget nulla sollicitudin, ac molestie justo ullamcorper. In ullamcorper, nisl nec pretium tristique, ex augue consequat nisi, non accumsan arcu est non turpis. Proin massa dui, mattis non est vitae, mollis vehicula sapien. Fusce sed nunc facilisis, dictum tellus at, rhoncus lorem. Etiam elementum varius arcu, ut tincidunt enim tempor et. Donec pulvinar nisl non enim porta, vel efficitur libero tristique. Proin euismod quam id justo iaculis cursus. Praesent sit amet leo enim. Ut malesuada pretium quam nec luctus.");
        $pitch8->setCategory($category);

        $pitch9 = new Pitch();
        $pitch9->setTitle("Poisson volant");
        $pitch9->setDescription("Curabitur et pharetra elit, sed placerat nunc. Cras ultricies commodo lorem ac pulvinar. Phasellus porttitor maximus lacus, eget semper dolor cursus eget. Cras a pellentesque purus, nec posuere neque. Sed ligula augue, sodales in tincidunt vel, commodo ut nisl. Phasellus posuere est eget nulla sollicitudin, ac molestie justo ullamcorper. In ullamcorper, nisl nec pretium tristique, ex augue consequat nisi, non accumsan arcu est non turpis. Proin massa dui, mattis non est vitae, mollis vehicula sapien. Fusce sed nunc facilisis, dictum tellus at, rhoncus lorem. Etiam elementum varius arcu, ut tincidunt enim tempor et. Donec pulvinar nisl non enim porta, vel efficitur libero tristique. Proin euismod quam id justo iaculis cursus. Praesent sit amet leo enim. Ut malesuada pretium quam nec luctus.");
        $pitch9->setCategory($category);

        $user = new User();
        $user->setUsername('Xavier');
        $user->setPlainPassword('deadpool');
        $user->setEmail('xkoma@nextoo.fr');
        $user->setDescription('Food & Drinking');

        foreach ($comments as $c) {
            $comment = new Comment();
            $comment->setText($c);
            $comment->setPitch($pitch);
            $pitch->addComment($comment);

        }
        $pitch->setUser($user);
        $user->addPitch($pitch);

        $pitch1->setUser($user);
        $user->addPitch($pitch1);

        $pitch2->setUser($user);
        $user->addPitch($pitch2);

        $pitch3->setUser($user);
        $user->addPitch($pitch3);

        $pitch4->setUser($user);
        $user->addPitch($pitch4);

        $pitch5->setUser($user);
        $user->addPitch($pitch5);

        $pitch6->setUser($user);
        $user->addPitch($pitch6);

        $pitch7->setUser($user);
        $user->addPitch($pitch7);

        $pitch8->setUser($user);
        $user->addPitch($pitch8);

        $pitch9->setUser($user);
        $user->addPitch($pitch9);

        $manager->persist($user);
        $manager->flush();
    }
}
