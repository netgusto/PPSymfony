<?php

namespace Pulpy\CoreBundle\Exception\MaintenanceNeeded;

class DatabaseUnkownMaintenanceNeededException
    extends \Exception
    implements MaintenanceNeededExceptionInterface {

    use MaintenanceNeededExceptionTrait;
}