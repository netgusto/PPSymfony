<?php

namespace Pulpy\CoreBundle\Exception\InitializationNeeded;

class SystemStatusMarkedAsUninitializedInitializationNeededException
    extends \Exception
    implements
        InitializationNeededExceptionInterface {
}