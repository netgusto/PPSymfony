<?php

use Habitat\Habitat;

$merged_env = array_merge($container->getParameter('environment'), Habitat::getAll());

$container->setParameter(
    'resolved_env',
    array_filter($merged_env, function($var) use (&$merged_env) {
        $res = in_array(key($merged_env), array('DATABASE_URL', 'INITIALIZATION_MODE', 'STORAGE', 'S3_BUCKET', 'S3_KEYID', 'S3_SECRET'));
        next($merged_env);
        return $res;
    })
);