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
  * @RequestParam(name="title",description="Title of the pitch",nullable=true,strict=false,requirements="[a-z]+")
  * @param ParamFetcher $paramFetcher
  * @ApiDoc(input="PitchBundle\Entity\Pitch")
  */
  public function postPitchAction(ParamFetcher $paramFetcher) {

  }
}
?>