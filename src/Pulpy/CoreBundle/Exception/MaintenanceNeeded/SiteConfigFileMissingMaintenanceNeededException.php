<?php

namespace Pulpy\CoreBundle\Exception\MaintenanceNeeded;

class SiteConfigFileMissingMaintenanceNeededException
    extends \Exception
    implements MaintenanceNeededExceptionInterface {

    use MaintenanceNeededExceptionTrait;

    protected $filepath;
    
    public function setFilePath($filepath) {
        $this->filepath = $filepath;
        return $this;
    }

    public function getFilePath() {
        return $this->filepath;
    }
}