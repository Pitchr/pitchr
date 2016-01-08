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
use UserBundle\Entity\User;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Common\Collections\Criteria;

class UsersController extends FOSRestController {
  /**
  * Get a user
  *
  * @Get("/users/{username}",requirements={"_format"="json"})
  * @param ParamFetcher $paramFetcher
  * @param string $username
  * @ApiDoc(statusCodes={200="Success",404="User was not found"})
  */
  public function getUserAction (ParamFetcher $paramFetcher,$username) {
    $em = $this->getDoctrine()->getManager();
    $query = $em->createQuery("select u from UserBundle\Entity\User u where u.usernameCanonical = ?1 or u.username = ?1");
    $query->setParameter(1,$username);

    try {
        $user = $query->getSingleResult();
        $view = $this->view(array("success" => true,"user" => $user->getSafeObject()),200);
    }
    catch (NonUniqueResultException $nure) {
        $view = $this->view(array("success" => false,"message" => $nure->getMessage()),500);
    }
    catch (NoResultException $nre) {
        $view = $this->view(array("success" => false,"message" => "No user found : '".$username."'"),404);
    }
    return $this->handleView($view);
  }

  /**
  * Get the authenticated user
  *
  * @Get("/me",requirements={"_format"="json"})
  * @ApiDoc(statusCodes={200="Success"})
  */
  public function getMeAction () {
    $view = $this->view(array("success" => true,"user" => $this->getUser()->getSafeObject()),200);
    return $this->handleView($view);
  }

  /**
  * Creates a new user
  *
  * @Post("/users/",requirements={"_format"="json"})
  * @RequestParam(name="username",requirements=".+")
  * @RequestParam(name="email",requirements=".+")
  * @RequestParam(name="description",requirements=".*",nullable=true)
  * @RequestParam(name="name",requirements=".+")
  * @RequestParam(name="password",requirements=".+")
  * @param ParamFetcher $paramFetcher
  * @ApiDoc(input={"class"="UserBundle\Entity\Pitch","groups"={"post"}})
  */
  public function postPitchAction(ParamFetcher $paramFetcher) {
      $em = $this->getDoctrine()->getManager();
      $user = new User();
      $user->setUsername($paramFetcher->get('username'));
      $user->setEmail($paramFetcher->get('email'));
      $user->setDescription($paramFetcher->get('description'));
      $user->setName($paramFetcher->get('name'));
      $user->setPlainPassword($paramFetcher->get('password'));

      $this->createForm($type [, $data, $options])
      $em->persist($user);
      $em->flush();
      $view = $this->view(array("success" => true,"pitch" => $user->getSafeObject()),201);
      return $this->handleView($view);
  }
}
?>
