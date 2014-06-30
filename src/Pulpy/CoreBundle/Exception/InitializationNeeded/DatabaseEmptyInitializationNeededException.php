<?php

namespace Pulpy\CoreBundle\Exception\InitializationNeeded;

class DatabaseEmptyInitializationNeededException
    extends \Exception
    implements
        InitializationNeededExceptionInterface {
}