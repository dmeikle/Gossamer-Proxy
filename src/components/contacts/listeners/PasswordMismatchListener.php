<?php

namespace components\contacts\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use core\system\Router;


/**
 * Description of PasswordMismatchListener
 *
 * @author Dave Meikle
 */
class PasswordMismatchListener extends AbstractListener{
    
    const MAX_LOGIN_FAILURES = 6;
    
    public function on_login_password_mismatch(Event $event) {
        $params = $event->getParams();       
        $client = $params['client'];
        
        $datasource = $this->getDatasource('components\contacts\models\ContactAuthorizationModel');
 
        $datasource->execute("update ContactAuthorizations set failedLogins = failedLogins + 1 where username='" . $client->getCredentials() . "'");
        
        //now check to see if we need to lock them down
        $result = $datasource->execute("select failedLogins from ContactAuthorizations where username='" . $client->getCredentials() . "'");
        
        $failedLogins = current($result);
        $value = $failedLogins['failedLogins'];
        if($value >= self::MAX_LOGIN_FAILURES) {
            $datasource->execute("update ContactAuthorizations set status='locked' where username='" . $client->getCredentials() . "'");            
        }
       
        unset($datasource);
        unset($model);
    
        $router = new Router($this->logger, $this->httpRequest);
        $router->redirect('contacts_login_failed');
    }
}
