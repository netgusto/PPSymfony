<?php

namespace Pulpy\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Bundle\FrameworkBundle\Routing\Router,
    Twig_Environment;

use Pulpy\CoreBundle\Entity\Post,
    Pulpy\CoreBundle\Services\Post\PostRepository,
    Pulpy\CoreBundle\Services\PostFile\PostFileResolverService,
    Pulpy\CoreBundle\Services\Context\CultureService,
    Pulpy\CoreBundle\Services\Config\SiteConfigService;

class HomeController {

    protected $twig;
    protected $postRepo;
    protected $postpathresolver;
    protected $culture;
    protected $siteconfig;
    protected $postsperpage;
    protected $router;

    public function __construct(
        Twig_Environment $twig,
        PostRepository $postRepo,
        PostFileResolverService $postpathresolver,
        CultureService $culture,
        SiteConfigService $siteconfig,
        Router $router,
        $postsperpage = 5
    ) {
        $this->twig = $twig;
        $this->postRepo = $postRepo;
        $this->postpathresolver = $postpathresolver;
        $this->culture = $culture;
        $this->siteconfig = $siteconfig;
        $this->router = $router;
        $this->postsperpage = $postsperpage;
    }

    public function indexAction(Request $request, $page=1) {
        $nbposts = $this->postRepo->count();
        if($nbposts === 0) {
            
            $date = new \DateTime();
            $date->setTimezone($this->culture->getTimezone());

            $post = new Post();
            $post->setTitle('Oh no ! not a single post to display !');
            $post->setSlug('oh-noes');
            $post->setIntro("It looks like you don't have any post in your blog yet. To add a post, create a file in `data/posts`.");
            $post->setAuthor($this->siteconfig->getOwnername());
            $post->setDate($date);
            $post->setComments(FALSE);

            return new Response($this->twig->render('@PulpyTheme/Post/index.html.twig', array(
                'post' => $post,
            )));
        }
        
        $nbpages = ceil($nbposts / $this->postsperpage);
        $posts = $this->postRepo->findAllAtPage($page, $this->postsperpage);

        if($page > $nbpages) {
            return new RedirectResponse($this->router->generate('home'));
        }

        return new Response($this->twig->render('@PulpyTheme/Home/index.html.twig', array(
            'posts' => $posts,
            'page' => $page,
            'nbpages' => $nbpages,
        )));
    }
}