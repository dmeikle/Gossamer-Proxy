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
use components\staff\models\StaffModel;

/**
 * LoadStaffByIdListener
 *
 * @author Dave Meikle
 */
class LoadStaffRolesByIdListener extends AbstractListener{
    

    
    public function on_request_start($params) {         
      
        $staffId = intval($this->httpRequest->getQueryParameter('staffid'));
        
        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');
        $query = sprintf('select roles from StaffAuthorizations where Staff_id = %d limit 1', $staffId);
     
       // $rawResult = $datasource->execute($query);
       //TODO: this listener is being depricated. just hard code a result in until its retired
        $rawResult="IS_ADMINISTRATOR|IS_SUPER_USER|IS_MANAGER|IS_POWER_USER|IS_PROJECT_MANAGER";
        //if(is_array($rawResult)) {
            $this->httpRequest->setAttribute('ROLES', explode('|', $rawResult));
        //}
    }
}
