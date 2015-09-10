<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\controllers;

use core\AbstractController;

class StaffBenefitsController extends AbstractController {

    public function listAllByStaff($id) {
        $offset = 0;
        $limit = 100;
        $params = array('Staff_id' => intval($id));
        
        $result = $this->model->listAllWithParams($offset, $limit, $params, 'listByStaffId');
        
        $this->render($result);
    }
    
    public function listAllByDate($staffId, $date) {
        $offset = 0;
        $limit = 100;
        $params = array('Staff_id' => intval($staffId),
            'date' =>  date("Y-m-d", strtotime($date)));
        
        $result = $this->model->listAllWithParams($offset, $limit, $params, 'get');
        
        $this->render($result);
    }
    
    public function saveNewBenefit($staffId, $effectiveDate) {
        $result = $this->model->saveNewBenefit(intval($staffId), date("Y-m-d", strtotime($effectiveDate)));
        
        $this->render($result);
    }
}
