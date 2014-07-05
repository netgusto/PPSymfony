<?php

namespace Pulpy\RestBundle\Controller;

use FOS\RestBundle\View\View;

trait RestControllerTrait {

    protected function getViewHandler() {
        return $this->viewhandler;
    }

    protected function view($data = null, $statusCode = null, array $headers = array()) {
        return View::create($data, $statusCode, $headers);
    }

    public function handleView(View $view) {
        return $this->getViewHandler()->handle($view);
    }
}