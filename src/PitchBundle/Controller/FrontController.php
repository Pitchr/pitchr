<?php

namespace PitchBundle\Controller;

use PitchBundle\Entity\Category;
use PitchBundle\Entity\Comment;
use PitchBundle\Entity\Pitch;
use PitchBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FrontController extends Controller
{
    /**
     * @Route("/", name="home_page")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pitches = $em->getRepository("PitchBundle:Pitch")->findLastPitches();

        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $pitches,
            $request->query->getInt('page', 1),
            2
        );

        return $this->render('PitchBundle:Default:index.html.twig', array('pitches' => $pagination));
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
        $pitch->setViews($pitch->getViews() + 1);
        $em->persist($pitch);
        $em->flush();

        $more_pitches = $em->getRepository("PitchBundle:Pitch")->findMorePitches($user, $pitch);
        $all_pitches = $em->getRepository("PitchBundle:Pitch")->findAll();

        return $this->render('PitchBundle:Default:pitch_details.html.twig', array('pitch' => $pitch, 'more_pitches' => $more_pitches, 'all_pitches' => $all_pitches));
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
        $pitches = $em->getRepository("PitchBundle:Pitch")->findBy(array('category' => $category->getId()), array('createdAt' => 'desc'), 12);

        return $this->render('PitchBundle:Default:category.html.twig', array('category' => $category, 'pitches' => $pitches));
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
     * @Route("/comment-add/{pitch}", name="comment_add")
     * @return Response instance
     */
    public function commentAddAction(Request $request, Pitch $pitch)
    {
//todo: verfier si connecté

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $comment->setPitch($pitch);
            $comment->setUser($this->getUser());
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('pitch_details', array('slug' => $pitch->getSlug())));
        }

        return $this->render('PitchBundle:Default:comment_add.html.twig', array(
            'form' => $form->createView(),
            'pitch' => $pitch
        ));
    }
}
