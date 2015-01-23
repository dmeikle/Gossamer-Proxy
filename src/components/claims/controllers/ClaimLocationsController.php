<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\claims\controllers;

use core\AbstractController;


/**
 * Description of PropertiesController
 *
 * @author Dave Meikle
 */
class ClaimLocationsController extends AbstractController
{
   
    public function listLocationsByClaimId($claimId) {
        $result = $this->model->listLocationsByClaimId($claimId);
        
        $this->render($result);
    }
   
    public function viewLocation($claimId, $locationId) {
        $result = $this->model->viewLocation($claimId, $locationId);
        
        $this->render($result);
    }
    
    public function get($id) {
        $result = $this->model->get($id);
        
        $this->render($result);
    }
    
    public function saveRoom($locationId, $roomId) {
        $result = $this->model->saveRoom($locationId, $roomId);
        
        $this->render($result);
    }
    
    public function listWork($claimId, $locationId) {
        $result = $this->model->listWork($claimId, $locationId);
        
        $this->render($result);
    }
    
    public function locationHistory($claimId, $locationId) {
        $result = $this->model->locationHistory($claimId, $locationId);
        
        $this->render($result);
    }
    
    public function saveClaimsLocationPhotos($claimId, $locationId) {
        $result = $this->model->saveClaimsLocationPhotos($claimId, $locationId);
        
        $this->render($result);
    }
}
