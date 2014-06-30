<?php

namespace Pulpy\CoreBundle\Exception\MaintenanceNeeded;

class DatabaseInvalidCredentialsMaintenanceNeededException
    extends \Exception
    implements MaintenanceNeededExceptionInterface {

    use MaintenanceNeededExceptionTrait;
}