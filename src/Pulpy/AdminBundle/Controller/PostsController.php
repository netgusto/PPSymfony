<?php

namespace Pulpy\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;

use Twig_Environment;

use Pulpy\CoreBundle\Services\Post\PostRepository;

class PostsController {

    protected $twig;
    protected $postRepo;

    public function __construct(
        Twig_Environment $twig,
        PostRepository $postRepo
    ) {
        $this->twig = $twig;
        $this->postRepo = $postRepo;
    }

    public function indexAction(Request $request) {
        $posts = $this->postRepo->findAll();
        return new Response($this->twig->render('@PulpyAdmin/Posts/index.html.twig', array(
            'posts' => $posts,
        )));
    }
}