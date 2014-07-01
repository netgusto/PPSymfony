<?php

namespace Pulpy\CoreBundle\Provider\Platform;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Reference,
    Symfony\Component\DependencyInjection\Definition,
    Symfony\Component\ExpressionLanguage\Expression;


class ClassicPlatformProvider {
    public function __construct() {
    }

    public function injectServicesInContainer(ContainerBuilder $container) {

        #######################################################################

        $fspersistent = new Definition('Pulpy\CoreBundle\Services\PersistentStorage\LocalFSPersistentStorageService');
        $fspersistent->addArgument(new Expression("service('environment').getRootDir()"));
        $fspersistent->addArgument(new Expression("service('environment').getSiteUrl()"));

        $container->setDefinition(
            'fs.persistent',
            $fspersistent
        );

        #######################################################################

        $postcachehandler = new Definition('Pulpy\CoreBundle\Services\CacheHandler\LastModifiedPostCacheHandlerService');
        $postcachehandler->addArgument(new Reference('fs.persistent'));
        $postcachehandler->addArgument(new Reference('system.status'));
        $postcachehandler->addArgument(new Reference('postfile.repository'));
        $postcachehandler->addArgument(new Reference('post.repository'));
        $postcachehandler->addArgument(new Reference('postfile.topostconverter'));
        $postcachehandler->addArgument(new Reference('doctrine.orm.entity_manager'));
        $postcachehandler->addArgument(new Expression("service('config.site').getPostsDir()"));
        $postcachehandler->addArgument(new Reference("culture"));

        $container->setDefinition(
            'post.cachehandler',
            $postcachehandler
        );
    }
}