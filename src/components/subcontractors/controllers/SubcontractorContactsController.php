<?php

namespace components\subcontractors\controllers;

use core\AbstractController;

class SubcontractorContactsController extends AbstractController
{
    public function listallById($id) {
        $result = $this->model->listallById($id);
        
        $this->render($result);
    }
}
