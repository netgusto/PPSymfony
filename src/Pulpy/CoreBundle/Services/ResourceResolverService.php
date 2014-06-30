<?php

namespace Pulpy\CoreBundle\Services;

use Pulpy\CoreBundle\Services\PersistentStorage\PersistentStorageServiceInterface,
    Pulpy\CoreBundle\Entity\AbstractPost;

class ResourceResolverService {
    
    protected $fs;
    protected $resourcespath;
    
    public function __construct(PersistentStorageServiceInterface $fs, $resourcespath) {
        $this->fs = $fs;
        $this->resourcespath = rtrim($resourcespath, '/') . '/';
    }

    public function fileForResourceName($name) {
        
        $filepath = $this->resourcespath . $name;

        if(!$this->isFilepathLegit($filepath)) {
            return null;
        }

        return $this->fs->getOne($filepath);

        return $filepath;
    }

    public function urlForResourceName($name) {
        
        $file = $this->fileForResourceName($name);
        if(is_null($file)) {
            return null;
        }

        return $this->fs->getUrl($file);
    }

    public function isFilepathLegit($filepath) {

        $filepath = trim($filepath);
        if($filepath === '') {
            return FALSE;
        }

        if(preg_match('%\.\.%', $filepath)) {
            return FALSE;
        }

        if(mb_strlen($filepath, 'UTF-8') <= mb_strlen($this->resourcespath, 'UTF-8')) {
            return FALSE;
        }

        if(substr($filepath, 0, mb_strlen($this->resourcespath, 'UTF-8')) !== $this->resourcespath) {
            return FALSE;
        }

        $pathinfo = pathinfo($filepath);
        return (trim($pathinfo['filename']) !== '');
    }
}