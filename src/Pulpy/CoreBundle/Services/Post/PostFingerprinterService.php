<?php

namespace Pulpy\CoreBundle\Services\Post;

use Pulpy\CoreBundle\Entity\AbstractPost;

class PostFingerprinterService {
    
    public function __construct() {
    }

    public function fingerprint(AbstractPost $post) {

        $dna = array(
            $post->getTitle(),
            $post->getSlug(),
            $post->getAuthor(),
            $post->getTwitter(),
            $post->getDate(),
            $post->getIntro(),
            $post->getContent(),
            $post->getImage(),
            $post->getComments(),
            $post->getAbout(),
            $post->getMeta(),
        );

        return md5(serialize($dna));
    }
}