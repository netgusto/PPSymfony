<?php

namespace Pulpy\CoreBundle\Services\Post;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

use Pulpy\Entity\Post,
    Pulpy\CoreBundle\Services\Post\PostRepository,
    Pulpy\CoreBundle\Services\URLAbsolutizerService,
    Pulpy\CoreBundle\Exception;

class PostURLGeneratorService {

    protected $postRepo;
    protected $urlgenerator;
    protected $urlabsolutizer;
    
    public function __construct(PostRepository $postRepo, Router $urlgenerator, URLAbsolutizerService $urlabsolutizer) {
        $this->postRepo = $postRepo;
        $this->urlgenerator = $urlgenerator;
        $this->urlabsolutizer = $urlabsolutizer;
    }

    public function fromSlug($slug) {
        return $this->urlgenerator->generate('post', array(
            'slug' => $slug
        ));
    }

    public function absoluteFromSlug($slug) {
        return $this->urlabsolutizer->absoluteURLFromRoutePath(
            $this->fromSlug($slug)
        );
    }

    public function fromPost(Post $post) {
        return $this->fromSlug($post->getSlug());
    }

    public function absoluteFromPost(Post $post) {
        return $this->absoluteFromSlug($post->getSlug());
    }
}