<?php

namespace Pulpy\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\JsonResponse;

use Pulpy\CoreBundle\Services\Post\PostRepository,
    Pulpy\CoreBundle\Services\Post\PostSerializerService,
    Pulpy\CoreBundle\Exception;

class JsonController {

    protected $postRepo;
    protected $postserializer;

    public function __construct(PostRepository $postRepo, PostSerializerService $postserializer) {
        $this->postRepo = $postRepo;
        $this->postserializer = $postserializer;
    }

    public function indexAction(Request $request) {

        $res = array();

        # Export all posts
        $posts = $this->postRepo->findAll();
        foreach($posts as $post) {
            $res[] = $this->postserializer->serialize($post);
        }

        $response = new JsonResponse($res);

        return $response;
    }

    public function postAction(Request $request, $slug) {
        $post = $this->postRepo->findOneBySlug($slug);
        if(!$post) {
            throw new Exception\PostNotFoundException('Post with slug ' . $slug . ' does not exist.');
        }

        return new JsonResponse($this->postserializer->serialize($post));
    }
}