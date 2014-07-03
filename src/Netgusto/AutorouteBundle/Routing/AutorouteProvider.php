<?php

namespace Netgusto\AutorouteBundle\Routing;

use Symfony\Component\Routing\Loader\YamlFileLoader,
    Symfony\Component\Config\FileLocator;

use Netgusto\AutorouteBundle\Services\AutorouteProviderInterface;

class AutorouteProvider implements AutorouteProviderInterface {

    protected $resourcepath;

    public function __construct($resourcepath) {
        $this->resourcepath = $resourcepath;
    }

    public function getRouteCollection() {
        $loader = new YamlFileLoader(new FileLocator());
        return $loader->load($this->resourcepath);
    }
}