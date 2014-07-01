<?php

namespace Pulpy\CoreBundle\Services\Context;

use Habitat\Habitat;

use Pulpy\CoreBundle\Services\Context\DotEnvFileReaderService;

class EnvironmentResolverService {

    public function __construct(array $defaultenvironment = array()) {
        $this->defaultenvironment = $defaultenvironment;
        $this->resolvedenv = array_merge($defaultenvironment, Habitat::getAll());
    }

    public function getResolvedEnv() {
        return $this->resolvedenv;
    }
}