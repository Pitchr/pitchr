<?php

namespace APIBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use PitchBundle\Entity\Pitch;
use PitchBundle\Entity\Category;
use UserBundle\Entity\User;

class PitchesController extends FOSRestController {
  /**
  * Gets all the pitches
  *
  * @Get("/pitches/",requirements={"_format"="json"})
  * @QueryParam(name="limit", requirements="\d+", default="10", description="Limit the amount of pitches.")
  * @QueryParam(name="offset", requirements="\d+", default="0", description="Start at offset.")
  * @QueryParam(name="sort", requirements="-?[a-z_-]+",
  * nullable=true, description="Sort by field e.g.: 'views' for ASCENDING order, '-views' for DESCENDING order")
  * @param ParamFetcher $paramFetcher
  * @ApiDoc(statusCodes={200="Success"})
  */
  public function getPitchesAction (ParamFetcher $paramFetcher) {

      $em = $this->getDoctrine()->getManager();
      $pitches = $em->getRepository("PitchBundle:Pitch")->filterObjectsByQuery($paramFetcher->all(), 'slug');
      $view = $this->view(array("success" => true,"pitches" => $pitches,"amount" => count($pitches)),200);
      return $this->handleView($view);
  }

  /**
  * Gets a single pitch by slug
  *
  * @Get("/pitches/{slug}",requirements={"_format"="json","slug"="[a-z0-9_-]+"})
  * @param ParamFetcher $paramFetcher
  * @param string $slug
  * @ApiDoc(statusCodes={200="Success",404="Pitch was not found"},
  * requirements={{"name"="slug","dataType"="string","requirement"="[a-z0-9_-]+","description"="The slug of the pitch"}})
  */
  public function getPitchAction (ParamFetcher $paramFetcher,$slug) {
      $em = $this->getDoctrine()->getManager();
      $pitch = $em->getRepository("PitchBundle:Pitch")->findOneBy(array("slug" => $slug));
      if (!empty($pitch)) {
          $view = $this->view(array("success" => true,"pitch" => $pitch->getSafeObject()),200);
      }
      else {
          $view = $this->view(array("success" => false),404);
      }
      return $this->handleView($view);
  }

  /**
  * Creates a new pitch
  *
  * @Post("/pitches/",requirements={"_format"="json"})
  * @RequestParam(name="title",requirements=".+")
  * @RequestParam(name="description",requirements=".+")
  * @RequestParam(name="category",requirements=".+")
  * @param ParamFetcher $paramFetcher
  * @ApiDoc(input={"class"="PitchBundle\Entity\Pitch","groups"={"post"}})
  */
  public function postPitchAction(ParamFetcher $paramFetcher) {
      $user = $this->getUser();
      $em = $this->getDoctrine()->getManager();
      $category = $em->getRepository("PitchBundle:Category")->findOneBy(array("slug" => $paramFetcher->get('category')));
      if (empty($category)) {
          $view = $this->view(array("success" => false,"message" => "Unknown category : '".$paramFetcher->get('category')."'"),400);
          return $this->handleView($view);
      }
      $pitch = new Pitch();
      $pitch->setTitle($paramFetcher->get('title'));
      $pitch->setDescription($paramFetcher->get('description'));
      $pitch->setUser($user);
      $pitch->setCategory($category);
      $user->addPitch($pitch);
      $em->persist($user);
      $em->flush();
      $view = $this->view(array("success" => true,"pitch" => $pitch->getSafeObject()),201);
      return $this->handleView($view);
  }
}
?>
