<?php

namespace Pulpy\CoreBundle\Exception\MaintenanceNeeded;

class DatabaseUpdateMaintenanceNeededException
    extends \Exception
    implements MaintenanceNeededExceptionInterface {

    use MaintenanceNeededExceptionTrait;
}