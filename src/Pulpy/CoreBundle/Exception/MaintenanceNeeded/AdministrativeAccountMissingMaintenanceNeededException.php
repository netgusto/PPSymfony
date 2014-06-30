<?php

namespace Pulpy\CoreBundle\Exception\MaintenanceNeeded;

class AdministrativeAccountMissingMaintenanceNeededException
    extends \Exception
    implements MaintenanceNeededExceptionInterface {

    use MaintenanceNeededExceptionTrait;
}