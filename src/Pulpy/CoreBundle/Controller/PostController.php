<?php

namespace Pulpy\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Twig_Environment;

use Pulpy\CoreBundle\Services\Post\PostRepository,
    Pulpy\CoreBundle\Services\PostFile\PostFileResolverService,
    Pulpy\CoreBundle\Exception;

class PostController {

    protected $twig;
    protected $postRepo;
    protected $postresolver;

    public function __construct(Twig_Environment $twig, PostRepository $postRepo, PostFileResolverService $postresolver) {
        $this->twig = $twig;
        $this->postRepo = $postRepo;
        $this->postresolver = $postresolver;
    }

    public function indexAction(Request $request, $slug) {

        $post = $this->postRepo->findOneBySlug($slug);
        if(!$post) {
            throw new Exception\PostNotFoundException('Post with slug ' . $slug . ' does not exist.');
        }

        $posts = $this->postRepo->findAll();

        $nextpost = $this->postRepo->findNext($post);
        $previouspost = $this->postRepo->findPrevious($post);
        #var_dump($previouspost);

        return new Response($this->twig->render('@PulpyTheme/Post/index.html.twig', array(
            'post' => $post,
            'posts' => $posts,
            'nextpost' => $nextpost,
            'previouspost' => $previouspost,
        )));
    }
}