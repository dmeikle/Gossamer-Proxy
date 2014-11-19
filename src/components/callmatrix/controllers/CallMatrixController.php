<?php
namespace components\callmatrix\controllers;

use core\AbstractController;


/**
 * Description of PropertiesController
 *
 * @author davem
 */
class CallMatrixController extends AbstractController{
   
    public function search() {
        $result = $this->model->search();
        
        $this->render($result);
    }
    
    public function showCalendar($year, $month) {
        $result = $this->model->showCalendar($year, $month);
        
        $this->render($result);
    }
    public function listByDate($year, $month) {
        $result = $this->model->listByDate($year, $month);
        
        $this->render($result);
    }
    
    public function showAddStaff($year, $month) {
        $result = $this->model->showAddStaff($year, $month);
        
        $this->render($result);
    }
}
