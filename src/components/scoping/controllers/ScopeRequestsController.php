<?php

namespace components\scoping\controllers;

use core\AbstractController;

class ScopeRequestsController extends AbstractController
{
    public function saveContact($id) {
        $result = $this->model->saveContact($id);
        
        $this->render($result);
    }
    
    public function loadContact($id) {
        $result = $this->model->loadContact($id);
        
        $this->render($result);
    }
    
    public function getTakeoff($id) {
        $result = $this->model->getTakeoff($id);
        
        $this->render($result);
    }
}
