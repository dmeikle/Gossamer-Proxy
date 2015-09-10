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
 * Description of TimesheetsController
 *
 * @author Dave Meikle
 */
class TimesheetsController extends AbstractController{
   
    public function listBreakdown($staffId, $date) {
        $offset = 0;
        $limit = 20;
        $params = array(
            'Staff_id' => intval($staffId),
            'date' => date("Y-m-d", strtotime($date))
        );
      
        $result = $this->model->listAllWithParams($offset, $limit, $params, 'breakdown');
        
        $this->render($result);
    }
}
