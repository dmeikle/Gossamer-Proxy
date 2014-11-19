<?php


namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;

/**
 * Description of SaveUserAuthorizationsListener
 *
 * @author davem
 */
class SaveStaffAuthorizationsListener extends AbstractListener{
      
    public function on_save_success($params) {
        $staffId = $params['id'];
        $query = sprintf("update StaffAuthorizations set roles = '" . $this->buildArray($params) .
           "' where Staff_id = %d", $staffId);
         
        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');
        $result = $datasource->query($query);        
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
