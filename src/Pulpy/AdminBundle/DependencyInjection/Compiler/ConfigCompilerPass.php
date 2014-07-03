<?php

namespace Pulpy\AdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Definition;

class ConfigCompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        $container->getDefinition('twig.loader.filesystem')->addMethodCall('addPath', array('%srcdir%/Pulpy/AdminBundle/Resources/views', 'PulpyAdmin'));
    }
}