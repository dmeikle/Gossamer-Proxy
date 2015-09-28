<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\callmatrix\controllers;

use core\AbstractController;


/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
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
