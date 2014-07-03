<?php

namespace Pulpy\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Security\Core\SecurityContext,
    Twig_Environment;

class AuthController {

    protected $twig;
    protected $securitycontext;

    public function __construct(Twig_Environment $twig, SecurityContext $securitycontext) {
        $this->twig = $twig;
        $this->securitycontext = $securitycontext;
    }

    public function indexAction(Request $request) {
        if($this->securitycontext->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new \Exception("Error Processing Request", 1);
        }

        if($this->securitycontext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw new \Exception("Error Processing Request", 1);
        }

        return new Response($this->twig->render('@PulpyAdmin/Auth/index.html.twig', array(
            // last username entered by the user
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error' => $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR),
        )));
    }
}