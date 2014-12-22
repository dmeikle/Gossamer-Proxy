<?php


namespace components\contacts\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;

/**
 * Description of SaveStaffLocallyListener
 *
 * @author davem
 */
class SaveContactLocallyListener extends AbstractListener{
    
    const MAX_PASSWORD_HISTORY = 6;
    
    public function on_save_success(Event $event) {
        $params = $event->getParams();
      
        $contactId = $params['Contacts_id'];
       
        $datasource = $this->getDatasource('components\staff\models\ContactAuthorizationModel');
        $query = sprintf('select * from ContactAuthorizations where Contacts_id = %d limit 1', $contactId);
        $contacts = array();
        $rowId = 'null';
        
        $rawResult = $datasource->execute($query);
        if(is_array($rawResult) && count($rawResult) > 0) {
            $contacts = current($rawResult);
            $rowId = $contacts['id'];
        }
       
        $this->setPasswordArray($contacts, $params);
        
        $query = "insert into ContactAuthorizations (id, username, password, passwordHistory, status, Contacts_id) values ( $rowId," 
                . "'" . $params['username'] . "','" . $params['password'] . "','" . $params['passwordHistory'] 
                . "','active','" . $params['Contacts_id'] . "') on duplicate key update "
                . "username ='" . $params['username'] . "', password = '" . $params['password'] . "', passwordHistory = '"
                . $params['passwordHistory'] . "'";
    
       $datasource->execute($query);
      
    }

    private function setPasswordArray(array $contacts, &$postedContact) {
        
        if(count($contacts) < 1) {
            $postedContact['passwordHistory'] = $postedContact['password'];
            return ;
        }
        $passwords = explode('|', $contacts['passwordHistory']);
        $passwords[] = $postedContact['password'];
        if(count($passwords) > self::MAX_PASSWORD_HISTORY) {
            //remove the first element to make room for the new one
            array_shift($passwords);
        }
        
        $postedContact['passwordHistory'] = implode('|', $passwords);
    }    
             
}
