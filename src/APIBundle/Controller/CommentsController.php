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

class CommentsController extends FOSRestController {
    /**
     * Gets all the comments
     *
     * @Get("/comments/",requirements={"_format"="json"})
     * @QueryParam(name="limit", requirements="\d+", default="10", description="Limit the amount of comments.")
     * @QueryParam(name="offset", requirements="\d+", default="0", description="Start at offset.")
     * @QueryParam(name="sort", requirements="-?[a-z_-]+",
     * nullable=true, description="Sort by field e.g.: 'views' for ASCENDING order, '-views' for DESCENDING order")
     * @param ParamFetcher $paramFetcher
     * @ApiDoc(statusCodes={200="Success"})
     */
    public function getCommentsAction (ParamFetcher $paramFetcher) {
        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository("PitchBundle:Comment")->filterObjectsByQuery($paramFetcher->all(), 'id');
        $view = $this->view(array("success" => true,"comments" => $comments,"amount" => count($comments)),200);
        return $this->handleView($view);
    }

    /**
     * Gets a single comment by id
     *
     * @Get("/comments/{id}",requirements={"_format"="json","id"="[0-9]+"})
     * @param ParamFetcher $paramFetcher
     * @param int $id
     * @ApiDoc(statusCodes={200="Success",404="Comment was not found"},
     * requirements={{"name"="id","dataType"="int","requirement"="[0-9]+","description"="The id of the comment"}})
     */
    public function getCommentAction (ParamFetcher $paramFetcher, $id) {
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository("PitchBundle:Comment")->find($id);
        if (!empty($comment)) {
            $view = $this->view(array("success" => true,"comment" => $comment->getSafeObject()),200);
        }
        else {
            $view = $this->view(array("success" => false),404);
        }
        return $this->handleView($view);
    }

    /**
     * Creates a new comment
     *
     * @Post("/comments/",requirements={"_format"="json"})
     * @RequestParam(name="text",description="Text of the comment",nullable=true,strict=false,requirements="[a-z]+")
     * @param ParamFetcher $paramFetcher
     * @ApiDoc(input="PitchBundle\Entity\Comment")
     */
    public function postCommentAction(ParamFetcher $paramFetcher) {

    }
}
?>
