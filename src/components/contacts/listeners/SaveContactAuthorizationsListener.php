<?php


namespace components\contacts\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;


/**
 * Description of SaveUserAuthorizationsListener
 *
 * @author davem
 */
class SaveContactAuthorizationsListener extends AbstractListener{
    
    public function on_save_success(Event $event) {
        $params = $event->getParams();
        $datasource = $this->getDatasource('components\contacts\models\ContactAuthorizationModel');
        $contactId = $params['userAuthorizations']['id'];
        
        $result = $datasource->query(sprintf("update ContactAuthorizations set roles = '" . $this->buildArray($params['userAuthorizations']) .
           "' where Contacts_id = %d", $contactId));
      
    }
        
    private function buildArray(array $authorizations) {
        unset($authorizations['id']);
        $retval = '';
          
        foreach($authorizations as $key => $value) {            
            $retval .= "|$key";
        }
        
        return substr($retval,1);
    }
}
