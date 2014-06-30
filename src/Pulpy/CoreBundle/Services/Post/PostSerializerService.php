<?php

namespace Pulpy\CoreBundle\Services\Post;

use Pulpy\CoreBundle\Services\Post\PostRepository,
    Pulpy\CoreBundle\Services\URLAbsolutizerService,
    Pulpy\CoreBundle\Services\Context\CultureService,
    Pulpy\CoreBundle\Services\TextProcessor\Markdown\MarkdownProcessorInterface,
    Pulpy\CoreBundle\Exception;

class PostSerializerService {

    protected $postRepo;
    protected $markdownprocessor;
    protected $posturlgenerator;
    protected $urlabsolutizer;
    protected $postresourceresolver;
    protected $siteconfig;
    
    public function __construct(
        PostRepository $postRepo,
        MarkdownProcessorInterface $markdownprocessor,
        PostURLGeneratorService $posturlgenerator,
        URLAbsolutizerService $urlabsolutizer,
        PostResourceResolverService $postresourceresolver,
        CultureService $culture
    ) {
        $this->postRepo = $postRepo;
        $this->markdownprocessor = $markdownprocessor;
        $this->posturlgenerator = $posturlgenerator;
        $this->urlabsolutizer = $urlabsolutizer;
        $this->postresourceresolver = $postresourceresolver;
        $this->culture = $culture;
    }

    public function serialize($post) {

        $postintro = trim($this->markdownprocessor->toInlineHtml($post->getIntro()));
        $postcontent = trim($this->markdownprocessor->toHtml($post->getContent()));

        $url = $this->posturlgenerator->absoluteFromSlug($post->getSlug());

        $imagerelpath = $post->getImage();
        if($imagerelpath) {
            $imageurl = $this->postresourceresolver->urlForPostAndResourceName(
                $post,
                $imagerelpath
            );
        } else {
            $imageurl = null;
        }

        $previouspost = $this->postRepo->findPrevious($post);
        $nextpost = $this->postRepo->findNext($post);

        return array(
            'url' => $url,
            'slug' => $post->getSlug(),
            'image' => $imageurl,
            'title' => trim($post->getTitle()),
            'intro' => $postintro,
            'content' => $postcontent,
            'author' => $post->getAuthor(),
            'twitter' => $post->getTwitter(),
            'about' => $post->getAbout(),
            'date_human' => $this->culture->humanDate($post->getDate()),
            'date_iso' => $post->getDate()->format('c'),    # ISO 8601; equivalent to (new Date()).toJSON() in javascript
            'comments' => $post->getComments(), # true / false
            'next_slug' => $nextpost ? $nextpost->getSlug() : null,
            'previous_slug' => $previouspost ? $previouspost->getSlug() : null,
        );
    }
}