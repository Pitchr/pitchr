<?php
/**
 * Created by IntelliJ IDEA.
 * User: alessio
 * Date: 18/12/15
 * Time: 15:12
 */

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseController;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use UserBundle\Entity\User;

class ProfileController extends BaseController
{
    public function showAction(User $user = null)
    {
        if ($user === null) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }
        }
        $manager = $this->getDoctrine()->getManager();
        $views = $manager->getRepository('UserBundle:User')->findTotalPitchViewsByUser($user);

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'views' => $views
        ));
    }
}
