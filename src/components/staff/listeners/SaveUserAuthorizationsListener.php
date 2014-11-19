<?php


namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;

/**
 * Description of SaveUserAuthorizationsListener
 *
 * @author davem
 */
class SaveUserAuthorizationsListener extends AbstractListener{
    
    public function on_save_success($params) {
        echo "SaveUserAuthorizationsListener";
           pr($params);
        $staffId = $params['id'];
         echo sprintf("<br>update StaffAuthorizations set roles = \'" . $this->buildArray($params['userAuthorizations']) .
           "\' where Staff_id = %d", $staffId);
        $result = $this->datasource->query(sprintf("update StaffAuthorizations set roles = \'" . $this->buildArray($params['userAuthorizations']) .
           "\' where Staff_id = %d", $staffId));
       
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
