<?php

use Habitat\Habitat;

$container->setParameter(
    'resolved_env',
    array_merge($container->getParameter('environment'), Habitat::getAll())
);