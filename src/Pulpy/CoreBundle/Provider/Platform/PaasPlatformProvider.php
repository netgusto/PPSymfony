<?php

namespace Pulpy\CoreBundle\Provider\Platform;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Reference,
    Symfony\Component\DependencyInjection\Definition,
    Symfony\Component\ExpressionLanguage\Expression;


class PaasPlatformProvider {
    public function __construct() {
    }

    public function injectServicesInContainer(ContainerBuilder $container) {

        $fspersistent = new Definition('Pulpy\CoreBundle\Services\PersistentStorage\S3PersistentStorageService');
        $fspersistent->addArgument(new Expression("service('environment').getEnv('S3_BUCKET')"));
        $fspersistent->addArgument(new Expression("service('environment').getEnv('S3_KEYID')"));
        $fspersistent->addArgument(new Expression("service('environment').getEnv('S3_SECRET')"));
        $fspersistent->addArgument(new Expression("service('environment').getScheme() ~ '://' ~ service('environment').getEnv('S3_BUCKET') ~ '.s3.amazonaws.com'"));

        $container->setDefinition(
            'fs.persistent',
            $fspersistent
        );

        #######################################################################

        $postcachehandler = new Definition('Pulpy\CoreBundle\Services\CacheHandler\EventedPostCacheHandlerService');
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