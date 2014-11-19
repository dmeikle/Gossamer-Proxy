<?php
namespace components\notifications\controllers;

use core\AbstractController;


/**
 * Description of PropertiesController
 *
 * @author davem
 */
class AlertsController extends AbstractController{
   
    public function search() {
        $result = $this->model->search();
        
        $this->render($result);
    }
}
