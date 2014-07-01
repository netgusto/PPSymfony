<?php

use Habitat\Habitat;

use Pulpy\CoreBundle\Services\DatabaseUrlResolverService;

$env = Habitat::getAll();
$databaseurl = isset($env["DATABASE_URL"]) ? $env["DATABASE_URL"] : FALSE;

unset($env);

if($databaseurl === FALSE) {
    $container->setParameter('database_driver', $container->getParameter('default_database_driver'));
    $container->setParameter('database_host', $container->getParameter('default_database_host'));
    $container->setParameter('database_port', $container->getParameter('default_database_port'));
    $container->setParameter('database_name', $container->getParameter('default_database_name'));
    $container->setParameter('database_user', $container->getParameter('default_database_user'));
    $container->setParameter('database_password', $container->getParameter('default_database_password'));
    $container->setParameter('database_path', $container->getParameter('default_database_path'));
} else {

    $dbresolver = new DatabaseUrlResolverService();
    $dbparameters = $dbresolver->resolve($databaseurl);
    var_dump($dbparameters);
    die();

    foreach($dbparameters as $parametername => $parametervalue) {
        $container->setParameter('database_' . $parametername, $parametervalue);
    }
}