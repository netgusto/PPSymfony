<?php

namespace Pulpy\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;

use Twig_Environment;

use Pulpy\CoreBundle\Services\Post\PostRepository;

class AppController {

    protected $twig;

    public function __construct(
        Twig_Environment $twig
    ) {
        $this->twig = $twig;
    }

    public function indexAction(Request $request) {
        return new Response($this->twig->render('@PulpyAdmin/App/index.html.twig'));
    }
}