<?php

namespace PitchBundle\Controller;

use PitchBundle\Entity\Category;
use PitchBundle\Entity\Pitch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FrontController extends Controller
{
    /**
     * @Route("/", name="home_page")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pitchs = $em->getRepository("PitchBundle:Pitch")->findLastPitchs();

        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $pitchs,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('PitchBundle:Default:index.html.twig', array('pitchs' => $pagination));
    }

    /**
     *
     * @Route("/test/{slug}", name="pitch_details")
     *
     * @param Pitch $pitch
     * @return Response instance
     */
    public function pitchDetailsAction(Pitch $pitch)
    {
        if ($pitch === null) {
            throw new NotFoundHttpException("Le pitch n'existe pas.");
        }

        $user = $pitch->getUser();

        $em = $this->getDoctrine()->getManager();
        
        // Permets d'incrémenter le compteur de vues.
        $pitch->setViews($pitch->getViews()+1);
        $em->persist($pitch);
        $em->flush();
        
        $more_pitchs = $em->getRepository("PitchBundle:Pitch")->findMorePitchs($user, $pitch);
        $all_pitchs = $em->getRepository("PitchBundle:Pitch")->findAll();

        return $this->render('PitchBundle:Default:pitch_details.html.twig', array('pitch' => $pitch, 'more_pitchs' => $more_pitchs, 'all_pitchs' => $all_pitchs));
    }

    /**
     * @Route("/category/{slug}", name="category")
     * @return Response instance
     */
    public function categoryAction(\PitchBundle\Entity\Category $category)
    {
        if ($category === null) {
            throw new NotFoundHttpException("La catégorie " . $category->getTitle() . " n'existe pas.");
        }

        $em = $this->getDoctrine()->getManager();
        $pitchs = $em->getRepository("PitchBundle:Pitch")->findBy(array('category' => $category->getId()), array('createdAt' => 'desc'), 11);

        return $this->render('PitchBundle:Default:category.html.twig', array('category' => $category, 'pitchs' => $pitchs));
    }

    /**
     * @return Response instance
     */
    public function categoriesListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository("PitchBundle:Category")->findAll();

        return $this->render('PitchBundle:Default:categories_list.html.twig', array('categories' => $categories));
    }

    /**
    * @return Response instance
    */
    public function pitchesMostViewedListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pitches = $em->getRepository("PitchBundle:Category")->findAllMostViewed();

        return $this->render('PitchBundle:Default:categories_list.html.twig', array('categories' => $categories));
    }

}
