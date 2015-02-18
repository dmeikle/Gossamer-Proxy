<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;
use components\staff\models\StaffModel;
use core\eventlisteners\Event;


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
        $model = new StaffModel($this->httpRequest, $this->httpResponse, $this->logger);
        $datasource = $this->getDatasource($model);
      
        
        $datasource->query("update StaffAuthorizations set failedLogins = ifnull(failedLogins,0) + 1 where username='" . $client->getCredentials() . "'");
        
        //now check to see if we need to lock them down
        $result = $datasource->query("select failedLogins from StaffAuthorizations  where username='" . $client->getCredentials() . "'");
        
        $failedLogins = current($result);
        $value = $failedLogins['failedLogins'];
        if($value >= self::MAX_LOGIN_FAILURES) {
            $datasource->query("update StaffAuthorizations set status='locked' where username='" . $client->getCredentials() . "'");
        }
        unset($datasource);
        unset($model);
    }
}
