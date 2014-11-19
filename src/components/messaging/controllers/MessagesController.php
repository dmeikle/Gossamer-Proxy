<?php
namespace components\messaging\controllers;

use core\AbstractController;


/**
 * Description of PropertiesController
 *
 * @author davem
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
}
