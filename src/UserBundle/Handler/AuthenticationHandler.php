<?php

namespace UserBundle\Handler;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;


class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface
{
    protected $router;
    protected $authorizationChecker;
    protected $userManager;
    protected $service_container;
    protected $flashBag;

    public function __construct(RouterInterface $router, AuthorizationChecker $authorizationChecker, $userManager, Container $service_container)
    {
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
        $this->userManager = $userManager;
        $this->service_container = $service_container;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($request->isXmlHttpRequest()) {
            $result = array('success' => true);
            $jsonResponse = new JsonResponse();
            $jsonResponse->setData($result);
            return $jsonResponse;
        } else {
//            $this->service_container->get('session')->getFlashBag()->add('error', 'Une erreur est survenue.');
            $url = $this->router->generate('fos_user_security_login');
            return new RedirectResponse($url);
        }
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if ($request->isXmlHttpRequest()) {
            $result = array(
                'success' => false,
                'function' => 'onAuthenticationFailure',
                'error' => true,
                'message' => $this->service_container->get('translator')->trans($exception->getMessage(), array(), 'FOSUserBundle')
            );
            $jsonResponse = new JsonResponse();
            $jsonResponse->setData($result);
            return $jsonResponse;
        }
        return new Response();
    }
}