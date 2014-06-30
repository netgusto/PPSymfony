<?php

namespace Pulpy\CoreBundle\Exception\MaintenanceNeeded;

trait MaintenanceNeededExceptionTrait {
    
    protected $label;

    public function setInformationalLabel($label) {
        $this->label = $label;
        return $this;
    }

    public function getInformationalLabel() {
        return $this->label;
    }
}