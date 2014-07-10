<?php

namespace Pulpy\RestBundle\Controller;

use FOS\RestBundle\View\View AS RestView,
    FOS\RestBundle\View\ViewHandler as RestViewHandler;

use JMS\Serializer\SerializerInterface,
    JMS\SecurityExtraBundle\Annotation\PreAuthorize;

use Pulpy\CoreBundle\Services\Post\PostRepository,
    Pulpy\CoreBundle\Entity\Post;

class PostsController {

    use RestControllerTrait;

    protected $viewhandler;
    protected $postRepo;

    public function __construct(RestViewHandler $viewhandler, PostRepository $postRepo, SerializerInterface $serializer) {
        $this->viewhandler = $viewhandler;
        $this->postRepo = $postRepo;
        $this->serializer = $serializer;
    }

    public function getPostsAction() {
        return $this->handleView(
            $this
                ->view()
                ->setData(array(
                    'posts' => $this->postRepo->findAll()
                ))
        );
    }

    /** @PreAuthorize("#post.getStatus() == 'publish' OR #post.getAuthor() == user OR hasRole('ROLE_ADMIN')") */

    public function getPostAction(Post $post) {
        return $this->handleView(
            $this
                ->view()
                ->setData($post)
        );
    }
}
