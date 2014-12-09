<?php


namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;

/**
 * Description of SaveStaffLocallyListener
 *
 * @author davem
 */
class SaveStaffPermissionsLocallyListener extends AbstractListener{
    
    const MAX_PASSWORD_HISTORY = 6;
    
    public function on_save_success(Event $event) {
       // $userAuthorizations = $this->httpRequest->getAttribute('postedParams');
        $params = $event->getParams();
        $staffId = $params['id'];
     
        unset($params['id']);
        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');
        $query = sprintf('select * from StaffAuthorizations where Staff_id = %d limit 1', $staffId);
     
        $rawResult = $datasource->execute($query);
        if(is_array($rawResult) && count($rawResult) > 0) {
            $staff = current($rawResult);
           
            $query = "update StaffAuthorizations set roles = '" . implode('|', array_keys($params)) . "' where Staff_id = " . $staffId;
            $datasource->execute($query);
           
        }
      
    }
       
}
