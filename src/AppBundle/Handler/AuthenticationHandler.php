<?php

namespace AppBundle\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface
{

    private $router;
    private $session;

    public function __construct(RouterInterface $router, Session $session){
        $this->router = $router;
        $this->session = $session;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        if($request->isXmlHttpRequest()) {
            return new JsonResponse(['success' => true]);
        } else {
            if($this->session->get('_security.main.target_path')) {
                $url = $this->session->get('_security.main.target_path');
            } else {
                // Forcer la redirection vers la page d'accueil si erreur
                $url = $this->router->generate('homepage');
            }

            // Si on a un type/role prédéfini, on redirige après la connexion (on se connecte depuis une campagne)
            if(!empty($request->query->get('type'))) {
                $url = $this->router->generate('inscription', ['type' => $request->query->get('type')]);
            }

            return new RedirectResponse($url);
        }
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
       if($request->isXmlHttpRequest()) {
           return new JsonResponse(['success' => false, 'message' => 'Merci de vérifier vos identifiants et de réessayer']);
       } else {
           $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
           return new RedirectResponse($this->router->generate('fos_user_security_login'));
       }
    }
}