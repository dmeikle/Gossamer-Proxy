<?php


namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;


/**
 * Description of SaveUserAuthorizationsListener
 *
 * @author davem
 */
class SaveUserAuthorizationsListener extends AbstractListener{
    
    public function on_save_success(Event $event) {
        $params = $event->getParams();
        $staffId = $params['id'];
         
        $query = sprintf("update StaffAuthorizations set roles = \'" . $this->buildArray($params['userAuthorizations']) .
           "\' where Staff_id = %d", $staffId);
        
        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');
        $result = $datasource->query($query); 
       echo $query.'<br>';
       pr($result);
       die;
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
