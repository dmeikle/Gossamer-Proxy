<?php


namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use components\staff\models\StaffAuthorizationModel;

/**
 * Description of UsernameExistsListener
 *
 * @author davem
 */
class UsernameExistsListener extends AbstractListener{
    
    public function on_request_start(Event $event = null) {
       
        $staff = new StaffAuthorizationModel($this->httpRequest, $this->httpResponse, $this->logger);
        $post = $this->httpRequest->getPost();
        $staffData = $post['staff'];
     
        $params = array('username'=> $staffData['username']);
        
        $datasource = $this->getDatasource('components\staff\models\StaffAuthorizationModel');
           
        $results = $datasource->query('get', $staff, 'get', $params);
        
        if(is_array($results) && array_key_exists('StaffAuthorization', $results)) {
            $failKey = $this->listenerConfig['params']['failkey'];  
            setSession('ERROR_RESULT', array('username' => 'VALIDATION_USERNAME_EXISTS'));
            //TODO: make this lookup based on failkey
            header("Location: /admin/staff/edit/0");
            /* Make sure that code below does not get executed when we redirect. */
            exit;
        }
    }
}
