<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use components\staff\models\StaffAuthorizationModel;

/**
 * LoadStaffByIdListener
 *
 * @author Dave Meikle
 */
class LoadStaffRolesByIdListener extends AbstractListener{
    

    
    public function on_request_start($params) {         
      
        $rawResult = $this->getStaffAuthorization($params);
        
        if(is_array($rawResult) && array_key_exists('StaffAuthorization', $rawResult)) {
            $roles = explode('|', $rawResult['StaffAuthorization'][0]['roles']);
            $this->httpResponse->setAttribute('roles', $roles);
        }
    }
    
    private function getStaffAuthorization($params) {
        $staffAuth = $this->httpRequest->getAttribute('StaffAuthorization');
        if(is_array($staffAuth) && array_key_exists('StaffAuthorization', $staffAuth)) {
            return $staffAuth;
        }
        
        $staffAuthorizationModel = new StaffAuthorizationModel($this->httpRequest, $this->httpResponse, $this->logger);
        $params = $this->httpRequest->getParameters();
        $staffId = 0;
        if(count($params) > 0 && intval($params[0]) > 0) {
            $staffId = intval($params[0]);
        } else {
            $staffId = $this->getLoggedInStaffId();
        }
        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');
        
        $rawResult = $datasource->query('get', $staffAuthorizationModel, 'get', array('Staff_id' => $staffId) );
        
        return $rawResult;
    }
}
