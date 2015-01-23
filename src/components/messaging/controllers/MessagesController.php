<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\messaging\controllers;

use core\AbstractController;


/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class MessagesController extends AbstractController{
   
    public function search() {
        $result = $this->model->search();
        
        $this->render($result);
    }
    
    public function create($claimId, $locationId, $discussionId) {
        $result = $this->model->create($claimId, $locationId, $discussionId);
        
        $this->render($result);
    }
    
    public function listallByClaim($claimId, $locationId) {
        $result = $this->model->listallByClaim($claimId, $locationId);
        
        $this->render($result);
    }
    
    public function listallByDiscussion($discussionId, $offset = 0, $limit = 20) {
        
        $params = array('');
        $result = $this->model->listallWithParams($offset, $limit, $params);
        
        $this->render($result);
    }
}
