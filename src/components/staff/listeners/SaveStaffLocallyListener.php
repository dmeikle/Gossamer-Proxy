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

/**
 * Description of SaveStaffLocallyListener
 *
 * @author Dave Meikle
 */
class SaveStaffLocallyListener extends AbstractListener{
    
    const MAX_PASSWORD_HISTORY = 6;
    
    public function on_save_success(Event $event) {
        $params = $event->getParams();
       
        $staffId = $params['Staff_id'];
       
        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');
        $query = sprintf('select * from StaffAuthorizations where Staff_id = %d limit 1', $staffId);
        $staff;
        $rowId = null;
        $rawResult = $datasource->execute($query);
        if(is_array($rawResult) && count($rawResult) > 0) {
            $staff = current($rawResult);
            $rowId = $staff['id'];
        }
        
        $this->setPasswordArray($staff, $params);
        $query = "insert into StaffAuthorizations (id, username, password, passwordHistory, status, Staff_id) values ( $rowId," 
                . "'" . $params['username'] . "','" . $params['password'] . "','" . $params['passwordHistory'] 
                . "','active','" . $params['Staff_id'] . "') on duplicate key update "
                . "username ='" . $params['username'] . "', password = '" . $params['password'] . "', passwordHistory = '"
                . $params['passwordHistory'] . "'";
    
       $datasource->execute($query);
      
    }

    private function setPasswordArray(array $staff, &$postedStaff) {
        
        if(count($staff) < 1) {
            $postedStaff['passwordHistory'] = $postedStaff['password'];
            return ;
        }
        $passwords = explode('|', $staff['passwordHistory']);
        $passwords[] = $postedStaff['password'];
        if(count($passwords) > self::MAX_PASSWORD_HISTORY) {
            //remove the first element to make room for the new one
            array_shift($passwords);
        }
        
        $postedStaff['passwordHistory'] = implode('|', $passwords);
    }    
             
}
