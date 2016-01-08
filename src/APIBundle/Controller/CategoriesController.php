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

class CategoriesController extends FOSRestController
{
    /**
     * Gets all the categories
     *
     * @Get("/categories/",requirements={"_format"="json"})
     * @QueryParam(name="limit", requirements="\d+", default="10", description="Limit the amount of categories.")
     * @QueryParam(name="offset", requirements="\d+", default="0", description="Start at offset.")
     * @QueryParam(name="sort", requirements="-?[a-z_-]+",
     * nullable=true, description="Sort by field e.g.: 'views' for ASCENDING order, '-views' for DESCENDING order")
     * @param ParamFetcher $paramFetcher
     * @ApiDoc(statusCodes={200="Success"})
     */
    public function getCategoriesAction(ParamFetcher $paramFetcher)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository("PitchBundle:Category")->filterObjectsByQuery($paramFetcher->all(), 'id');
        $view = $this->view(array("success" => true, "categories" => $categories, "amount" => count($categories)), 200);
        return $this->handleView($view);
    }

    /**
     * Gets a single category by id
     *
     * @Get("/categories/{id}",requirements={"_format"="json","id"="[0-9]+"})
     * @param ParamFetcher $paramFetcher
     * @param int $id
     * @ApiDoc(statusCodes={200="Success",404="Category was not found"},
     * requirements={{"name"="id","dataType"="int","requirement"="[0-9]+","description"="The id of the category"}})
     */
    public function getCategoryAction(ParamFetcher $paramFetcher, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository("PitchBundle:Category")->find($id);
        if (!empty($category)) {
            $view = $this->view(array("success" => true, "category" => $category->getSafeObject()), 200);
        } else {
            $view = $this->view(array("success" => false), 404);
        }
        return $this->handleView($view);
    }

    /**
     * Creates a new category
     *
     * @Post("/categories/",requirements={"_format"="json"})
     * @RequestParam(name="text",description="Text of the category",nullable=true,strict=false,requirements="[a-z]+")
     * @param ParamFetcher $paramFetcher
     * @ApiDoc(input="PitchBundle\Entity\Category")
     */
    public function postCategoryAction(ParamFetcher $paramFetcher)
    {

    }
}

?>
