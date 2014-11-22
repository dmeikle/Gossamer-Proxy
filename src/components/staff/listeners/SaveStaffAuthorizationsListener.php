<?php


namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;

/**
 * Description of SaveUserAuthorizationsListener
 *
 * @author davem
 */
class SaveStaffAuthorizationsListener extends AbstractListener{
      
    public function on_save_success(Event $event) {
        //$params = $event->getParams();

    //    pr($params);
//        $staffId = $params['id'];
//        $query = sprintf("update StaffAuthorizations set roles = '" . $this->buildArray($params) .
//           "' where Staff_id = %d", $staffId);
//         
//        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');
//        $result = $datasource->query($query);
        echo '<br>'. __YML_KEY.'<br>';
        $params = $event->getParams();
        $staffId = $params['id'];
       unset($params['id']);
        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');
        $query = sprintf('select * from StaffAuthorizations where Staff_id = %d limit 1', $staffId);
       echo $query;
        $rawResult = $datasource->execute($query);
        if(is_array($rawResult) && count($rawResult) > 0) {
            $staff = current($rawResult);
            $query = "update StaffAuthorizations set roles = '" . implode('|', $params) . "' where Staff_id = " . $staffId;
        }
        
       $datasource->execute($query);
    }
        
}
