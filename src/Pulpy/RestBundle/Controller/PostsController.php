<?php

namespace Pulpy\RestBundle\Controller;

use FOS\RestBundle\View\View AS RestView,
    FOS\RestBundle\View\ViewHandler as RestViewHandler;

use JMS\Serializer\SerializerInterface;

use Pulpy\CoreBundle\Services\Post\PostRepository;

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

        $view = $this->view();
        $data = $this->postRepo->findAll();
        
        if ($data) {
            $view->setStatusCode(200)->setData($data[0]);
        }

        return $this->handleView($view);
    }
}
