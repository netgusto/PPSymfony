<?php

namespace Pulpy\CoreBundle\Exception\InitializationNeeded;

class DatabaseMissingInitializationNeededException
    extends \Exception
    implements
        InitializationNeededExceptionInterface {
}