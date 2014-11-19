<?php


namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;

/**
 * Description of SaveStaffLocallyListener
 *
 * @author davem
 */
class SaveStaffLocallyListener extends AbstractListener{
    
    const MAX_PASSWORD_HISTORY = 6;
    
    public function on_save_success(Event $event) {
       // $userAuthorizations = $this->httpRequest->getAttribute('postedParams');
        $params = $event->getParams();
        $staffId = $params['id'];
        pr($params);
        die;
        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');
        $query = sprintf('select * from StaffAuthorizations where Staff_id = %d', $staffId);
        
        $staff = $datasource->execute($query);
        $this->setPasswordArray($staff, $params);
        $query = "insert into StaffAuthorizations (username, password, passwordHistory, status, Staff_id) values ("
                . "'" . $params['username'] . "','" . $params['password'] . "','" . $params['passwordHistory'] 
                . "','active','" . $params['id'] . "') on duplicate key update "
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
        if(count($passwords) >= self::MAX_PASSWORD_HISTORY) {
            //remove the first element to make room for the new one
            array_shift($passwords);
        }
        
        $passwords[] = $postedStaff['password'];
        $postedStaff['passwordHistory'] = $passwords;
    }    
             
}
