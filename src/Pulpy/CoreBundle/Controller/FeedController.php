<?php

namespace Pulpy\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Generator\UrlGenerator;

use \Suin\RSSWriter\Feed,
    \Suin\RSSWriter\Channel,
    \Suin\RSSWriter\Item;

use Pulpy\CoreBundle\Services\Post\PostRepository,
    Pulpy\CoreBundle\Services\Config\SiteConfigService,
    Pulpy\CoreBundle\Services\Post\PostSerializerService,
    Pulpy\CoreBundle\Services\Post\PostResourceResolverService,
    Pulpy\CoreBundle\Services\URLAbsolutizerService;

class FeedController {

    protected $postRepo;
    protected $postserializer;
    protected $postresourceresolver;
    protected $urlabsolutizer;
    protected $siteconfig;

    public function __construct(
        PostRepository $postRepo,
        PostSerializerService $postserializer,
        PostResourceResolverService $postresourceresolver,
        URLAbsolutizerService $urlabsolutizer,
        SiteConfigService $siteconfig
    ) {
        $this->postRepo = $postRepo;
        $this->postserializer = $postserializer;
        $this->postresourceresolver = $postresourceresolver;
        $this->urlabsolutizer = $urlabsolutizer;
        $this->siteconfig = $siteconfig;
    }

    public function indexAction(Request $request) {

        $feed = new Feed();
        $channel = new Channel();
        $channel
            ->title($this->siteconfig->getTitle())
            ->description($this->siteconfig->getDescription())
            ->url($this->urlabsolutizer->absoluteSiteURL())
            ->appendTo($feed);

        $finfo = finfo_open(FILEINFO_MIME_TYPE|FILEINFO_PRESERVE_ATIME);
        $posts = $this->postRepo->findAll();

        foreach($posts as $post) {

            $serializedpost = $this->postserializer->serialize($post);

            $item = new Item();
            $item
                ->title($serializedpost['title'])
                ->description($serializedpost['intro'])
                ->pubdate($post->getDate()->getTimestamp())
                ->url($serializedpost['url']);

            if($post->getImage()) {
                $imagepath = $this->postresourceresolver->filepathForPostAndResourceName($post, $post->getImage());
                $mimetype = finfo_file($finfo, $imagepath);
                $item->enclosure($serializedpost['image'], filesize($imagepath), $mimetype);
            }

            $item->appendTo($channel);
        }

        $response = new Response(
            $feed->__toString(),
            200,
            array(
                'content-type' => 'application/rss+xml'
            )
        );

        return $response;
    }
}