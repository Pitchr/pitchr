<?php

namespace APIBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class PitchesController extends FOSRestController {
  /**
  * Gets all the pitches
  *
  * @Get("/pitches/")
  * @Route(requirements={"_format"="json"})
  * @QueryParam(name="limit", requirements="\d+", default="10", description="Limit the amount of pitches.")
  * @QueryParam(name="offset", requirements="\d+", default="0", description="Start at offset.")
  * @QueryParam(name="sort", nullable=true, description="Sort by field")
  * @param ParamFetcher $paramFetcher
  * @ApiDoc(
  *  description="This is a description of your API method",
  * )
  */
  public function getPitchesAction (ParamFetcher $paramFetcher) {
      $em = $this->getDoctrine()->getManager();
      $pitches = $em->getRepository("PitchBundle:Pitch")->filterPitchesByQuery($paramFetcher->all());
      $view = $this->view($pitches,200);
      return $this->handleView($view);
  }

  /**
  * Gets a single pitch by slug
  *
  * @Get("/pitches/{slug}")
  * @Route(requirements={"_format"="json"})
  * @param ParamFetcher $paramFetcher
  * @param string $slug
  * @ApiDoc(
  *  description="This is a description of your API method",
  * )
  */
  public function getPitchAction (ParamFetcher $paramFetcher,$slug) {
      $em = $this->getDoctrine()->getManager();
      $pitch = $em->getRepository("PitchBundle:Pitch")->findOneBy(array("slug" => $slug));
      if (isset($pitch)) {
          $view = $this->view($pitch->getSafeObject(),200);
      }
      else {
          $view = $this->view($pitch,200);
      }
      return $this->handleView($view);
  }
}
?>
