<?php

namespace Pulpy\CoreBundle\Services\Post;

use Pulpy\CoreBundle\Entity\AbstractPost,
    Pulpy\CoreBundle\Services\ResourceResolverService;

class PostResourceResolverService extends ResourceResolverService {

    public function fileForPostAndResourceName(AbstractPost $post, $name) {
        return $this->fileForResourceName($name);
    }

    public function urlForPostAndResourceName(AbstractPost $post, $name) {
        
        $file = $this->fileForPostAndResourceName($post, $name);
        if(is_null($file)) {
            return null;
        }

        return $this->fs->getUrl($file);
    }
}