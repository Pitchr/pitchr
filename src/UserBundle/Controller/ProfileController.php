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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use UserBundle\Entity\User;

class ProfileController extends BaseController
{
    public function showAction(User $user = null, Request $request = null)
    {
        if ($user === null) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }
        }
        $em = $this->getDoctrine()->getManager();
        $views = $em->getRepository('UserBundle:User')->findTotalPitchViewsByUser($user);
        $pitchs = $em->getRepository('PitchBundle:Pitch')->findLastPitchsByUser($user);

        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $pitchs,
            $request->query->getInt('page', 1),
            2
        );

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'views' => $views,
            'pitchs' => $pagination
        ));
    }
}
