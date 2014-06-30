<?php

namespace Pulpy\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Definition;

class PlatformServiceCompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {

        # 1. Si le fichier de cache (PhpDumper) existe: Si debug=FALSE: renvoi
        # 2. Sinon: on génère la configuration; on dumpe
            # La configuration est injectée dans le container par un classe externe, chargée dynamiquement en fonction de $platform

        $platform = trim($container->get('environment')->getEnv('PLATFORM'));
        if(trim($platform) === '') {
            $platform = 'classic';
        }

        if($platform === 'paas') {
            /*
            config.loader.dbbacked:
                class: Pulpy\CoreBundle\Services\Config\Loader\DbBackedConfigLoaderService
                arguments:
                    - @doctrine.orm.entity_manager
                    - { data.dir: '' }

            config.site:
                class: Pulpy\CoreBundle\Services\Config\SiteConfigService
                arguments:
                    - @=service('config.loader.dbbacked').load('config.site')

            fs.persistent:
                class: Pulpy\CoreBundle\Services\PersistentStorage\S3PersistentStorageService
                arguments:
                    - @=service('environment').getEnv('S3_BUCKET')
                    - @=service('environment').getEnv('S3_KEYID')
                    - @=service('environment').getEnv('S3_SECRET')
                    - @=service('environment').getScheme() ~ '://' ~ service('environment').getEnv('S3_BUCKET') ~ '.s3.amazonaws.com'

            post.cachehandler:
                class: Pulpy\CoreBundle\Services\CacheHandler\EventedPostCacheHandlerService
                arguments:
                    - @fs.persistent
                    - @system.status
                    - @postfile.repository
                    - @post.repository
                    - @postfile.topostconverter
                    - @doctrine.orm.entity_manager
                    - @=service('config.site').getPostsDir()
                    - @culture
            */
        }
        die('laaa');

        /*
        $container->setDefinition(
            'test_service', new Definition(
                'Pulpy\CoreBundle\Services\ScalarInterpreterService'
            )
        );
        */

        
    }
}