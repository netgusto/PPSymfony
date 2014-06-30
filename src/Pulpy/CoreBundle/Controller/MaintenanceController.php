<?php

namespace Pulpy\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Twig_Environment;

use Pulpy\CoreBundle\Exception as PulpyException,
    Pulpy\CoreBundle\Services as PulpyServices;

class MaintenanceController {

    protected $twig;

    public function __construct(Twig_Environment $twig) {
        $this->twig = $twig;
    }

    public function reactToExceptionAction(Request $request, PulpyException\MaintenanceNeeded\MaintenanceNeededExceptionInterface $e) {

        /*
            Maintenance actions are not yet implemented in Pulpy;
            TODO: Implement maintenance actions and map them here
        */

        /*switch(TRUE) {
            case $e instanceOf PulpyException\MaintenanceNeeded\DatabaseInvalidCredentialsMaintenanceNeededException: {
                $action = 'databaseInvalidCredentialsAction';
                break;
            }
            case $e instanceOf PulpyException\MaintenanceNeeded\DatabaseUpdateMaintenanceNeededException: {
                $action = 'databaseUpdateAction';
                break;
            }
            case $e instanceOf PulpyException\MaintenanceNeeded\AdministrativeAccountMissingMaintenanceNeededException: {
                $action = 'administrativeAccountMissingAction';
                break;
            }
            case $e instanceOf PulpyException\MaintenanceNeeded\SystemStatusMissingMaintenanceNeededException: {
                $action = 'systemStatusMissingAction';
                break;
            }
            case $e instanceOf PulpyException\MaintenanceNeeded\SiteConfigFileMissingMaintenanceNeededException: {
                $action = 'siteConfigFileMissingAction';
                break;
            }
            default: {
                $action = 'unknownMaintenanceTaskAction';
                break;
            }
        }

        return $this->$action(
            $request,
            $e
        );*/
    }

    public function proceedWithRequestAction(Request $request, PulpyException\MaintenanceNeeded\MaintenanceNeededExceptionInterface $e) {
        /*
            Maintenance routes are not yet defined in Pulpy;
            TODO: Implement maintenance routes and map them here
        */
    }

    public function databaseInvalidCredentialsAction(Request $request, PulpyException\MaintenanceNeeded\DatabaseInvalidCredentialsMaintenanceNeededException $e) {
        return new Response($this->twig->render('@PulpyCore/Maintenance/databaseinvalidcredentials.html.twig'));
    }

    public function databaseUpdateAction(Request $request, PulpyException\MaintenanceNeeded\DatabaseUpdateMaintenanceNeededException $e) {
        return new Response($this->twig->render('@PulpyCore/Maintenance/databaseupdate.html.twig'));
    }

    public function administrativeAccountMissingAction(Request $request, PulpyException\MaintenanceNeeded\AdministrativeAccountMissingMaintenanceNeededException $e) {
        return new Response($this->twig->render('@PulpyCore/Maintenance/administrativeaccountmissing.html.twig'));
    }

    public function systemStatusMissingAction(Request $request, PulpyException\MaintenanceNeeded\SystemStatusMissingMaintenanceNeededException $e) {
        return new Response($this->twig->render('@PulpyCore/Maintenance/systemstatusmissing.html.twig'));
    }

    public function siteConfigFileMissingAction(Request $request, PulpyException\MaintenanceNeeded\SiteConfigFileMissingMaintenanceNeededException $e) {
        return new Response($this->twig->render('@PulpyCore/Maintenance/siteconfigfilemissing.html.twig'));
    }

    public function unknownMaintenanceTaskAction(Request $request, PulpyException\MaintenanceNeeded\MaintenanceNeededExceptionInterface $e) {
        return new Response($this->twig->render('@PulpyCore/Maintenance/unknownmaintenancetask.html.twig'));
    }
}