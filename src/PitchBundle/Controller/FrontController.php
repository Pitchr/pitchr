<?php

namespace PitchBundle\Controller;

use PitchBundle\Entity\Category;
use PitchBundle\Entity\Pitch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        return $this->render('PitchBundle:Default:pitch_details.html.twig', array('pitch' => $pitch));
    }

    /**
     * @Route("/category/{slug}", name="category")
     * @return Response instance
     */
    public function categoriesAction(\PitchBundle\Entity\Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $pitchs = $em->getRepository("PitchBundle:Pitch")->findBy(array('category' => $category), array('createdAt' => 'desc'), 11);

        return $this->render('PitchBundle:Default:categories.html.twig', array('pitchs' => $pitchs));
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
