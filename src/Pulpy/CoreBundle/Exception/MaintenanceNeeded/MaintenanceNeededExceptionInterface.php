<?php

namespace Pulpy\CoreBundle\Exception\MaintenanceNeeded;

interface MaintenanceNeededExceptionInterface {
    public function setInformationalLabel($label);
    public function getInformationalLabel();
}