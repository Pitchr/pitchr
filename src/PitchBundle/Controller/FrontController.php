<?php

namespace PitchBundle\Controller;

use PitchBundle\Entity\Category;
use PitchBundle\Entity\Pitch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class FrontController extends Controller
{
    /**
     * @Route("/", name="home_page")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pitchs = $em->getRepository("PitchBundle:Pitch")->findBy(array(), array("createdAt" => "desc"), 10);

        return $this->render('PitchBundle:Default:index.html.twig', array('pitchs' => $pitchs));
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
        $more_pitchs = $em->getRepository("PitchBundle:Pitch")->findMorePitchs($user, $pitch);

        return $this->render('PitchBundle:Default:pitch_details.html.twig', array('pitch' => $pitch, 'more_pitchs' => $more_pitchs));
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
}
