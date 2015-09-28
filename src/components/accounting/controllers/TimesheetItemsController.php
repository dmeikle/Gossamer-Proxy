<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\accounting\controllers;

use core\AbstractController;


/**
 * Description of TimesheetItemsController
 *
 * @author Dave Meikle
 */
class TimesheetItemsController extends AbstractController{
   
    public function listallByTimesheet($timesheetId, $offset, $limit) {
        $params = array (
            'id'   => intval($timesheetId)
        );
        
        $result = $this->model->listAllWithParams($offset, $limit, $params, 'list');
        
        $this->render($result);
    }
    
    public function editByTimesheet($timesheetId, $rowId) {
        $params = array (
            'AccountingTimesheets_id'   => intval($timesheetId),
            'id' => intval($rowId)
        );
        $offset = 0;
        $limit = 1;
        $result = $this->model->listAllWithParams($offset, $limit, $params, 'list');
        
        $this->render($result);
    }
}
