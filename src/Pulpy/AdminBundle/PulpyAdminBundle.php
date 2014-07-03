<?php

namespace Pulpy\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Compiler\PassConfig;

use Pulpy\AdminBundle\DependencyInjection\Compiler\ConfigCompilerPass;

class PulpyAdminBundle extends Bundle {
    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(
            new ConfigCompilerPass(),
            PassConfig::TYPE_BEFORE_OPTIMIZATION
        );
    }
}
