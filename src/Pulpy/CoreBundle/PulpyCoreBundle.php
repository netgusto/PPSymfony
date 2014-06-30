<?php

namespace Pulpy\CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Compiler\PassConfig;

use Pulpy\CoreBundle\DependencyInjection\Compiler\PlatformServiceCompilerPass;

class PulpyCoreBundle extends Bundle {
    
    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(
            new PlatformServiceCompilerPass(),
            PassConfig::TYPE_BEFORE_OPTIMIZATION
        );
    }
}