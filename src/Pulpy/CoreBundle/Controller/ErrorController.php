<?php

namespace Pulpy\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Twig_Environment;

class ErrorController {

    protected $twig;

    public function __construct(Twig_Environment $twig) {
        $this->twig = $twig;
    }

    public function notFoundAction(Request $request, \Exception $e, $code) {
        return new Response($this->twig->render('@PulpyTheme/Error/error.notfound.html.twig'));
    }

    public function errorAction(Request $request, \Exception $e, $code) {
        return new Response($this->twig->render('@PulpyTheme/Error/error.generic.html.twig'));
    }
}