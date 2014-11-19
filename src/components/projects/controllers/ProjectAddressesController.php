<?php
namespace components\projects\controllers;

use core\AbstractController;


/**
 * Description of PropertiesController
 *
 * @author davem
 */
class ProjectAddressesController extends AbstractController{
   
    public function search() {
        $result = $this->model->search();
        
        $this->render($result);
    }
}
