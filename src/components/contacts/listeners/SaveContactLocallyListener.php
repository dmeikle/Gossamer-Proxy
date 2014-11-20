<?php


namespace components\contacts\listeners;

use core\eventlisteners\AbstractListener;

/**
 * Description of SaveUserAuthorizationsListener
 *
 * @author davem
 */
class SaveContactLocallyListener extends AbstractListener{
    
    const MAX_PASSWORD_HISTORY = 6;
    
    public function on_save_success($params) {
       // $userAuthorizations = $this->httpRequest->getAttribute('postedParams');
       
        $contactId = $params['id'];
       
        $datasource = $this->getDatasource('components\contacts\models\ContactAuthorizationModel');
        $query = sprintf('select * from ContactAuthorizations where Contacts_id = %d', $contactId);
        
        $staff = $datasource->execute($query);
        if(is_null($staff)) {
            $staff = array();
        }
        $this->setPasswordArray($staff, $params);
        $query = "insert into ContactAuthorizations (username, password, passwordHistory, status, Contacts_id) values ("
                . "'" . $params['username'] . "','" . $params['password'] . "','" . $params['passwordHistory'] 
                . "','active','" . $contactId . "') on duplicate key update "
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
