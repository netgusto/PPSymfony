<?php

namespace Pulpy\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Definition;

class PlatformServiceCompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        
        $platform = trim($container->get('environment')->getEnv('PLATFORM'));

        if(trim($platform) === '') {
            $platform = 'Pulpy\CoreBundle\Provider\Platform\ClassicPlatformProvider';
        }

        $provider = new $platform();
        $provider->injectServicesInContainer($container);
    }
}