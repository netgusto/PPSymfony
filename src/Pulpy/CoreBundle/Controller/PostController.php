<?php

namespace Pulpy\CoreBundle\Controller;

use Silex\Application,
    Symfony\Component\HttpFoundation\Request,
    Twig_Environment;

use Pulpy\CoreBundle\Repository\PostRepository,
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

    public function indexAction(Request $request, Application $app, $slug) {

        $post = $this->postRepo->findOneBySlug($slug);
        if(!$post) {
            throw new Exception\PostNotFoundException('Post with slug ' . $slug . ' does not exist.');
        }

        $posts = $this->postRepo->findAll();

        $nextpost = $this->postRepo->findNext($post);
        $previouspost = $this->postRepo->findPrevious($post);
        #var_dump($previouspost);

        return $this->twig->render('@PulpyTheme/Post/index.html.twig', array(
            'post' => $post,
            'posts' => $posts,
            'nextpost' => $nextpost,
            'previouspost' => $previouspost,
        ));
    }
}