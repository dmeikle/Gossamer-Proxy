<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\ticker\controllers;


use core\AbstractController;


/**
 * Description of AnswersController
 *
 * @author Dave Meikle
 */
class TickerController extends AbstractController{

    public function requestToken($staffId, $ipAddress) {
        $staffId = intval($staffId);
        $ipAddress = urldecode($ipAddress);
        
        $token = $this->model->requestToken($staffId, $ipAddress);
       
        $this->render(array('token' => $token));
    }
    
    
    
}
