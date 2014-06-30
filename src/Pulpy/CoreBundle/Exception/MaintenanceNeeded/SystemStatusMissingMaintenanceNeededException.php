<?php

namespace Pulpy\CoreBundle\Exception\MaintenanceNeeded;

class SystemStatusMissingMaintenanceNeededException
    extends \Exception
    implements MaintenanceNeededExceptionInterface {

    use MaintenanceNeededExceptionTrait;
}