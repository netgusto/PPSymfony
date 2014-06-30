<?php

namespace Pulpy\CoreBundle\Services\Context;

use Habitat\Habitat;

use Pulpy\CoreBundle\Services\Context\DotEnvFileReaderService;

class EnvironmentResolverService {

    public function __construct($envfilepath) {
        $this->envfilepath = $envfilepath;
    }

    public function getResolvedEnv() {
        
        $env = Habitat::getAll();

        if(is_file($this->envfilepath)) {
            $envloader = new DotEnvFileReaderService();

            # Environment variables have priority over environment file variables
            $env = array_merge($envloader->read($this->envfilepath), $env);
        }

        return $env;
    }
}