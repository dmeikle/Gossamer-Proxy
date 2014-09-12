<?php

namespace components\users\listeners;

use core\eventlisteners\AbstractListener;
use components\users\models\UserModel;
/**
 * Description of PasswordMismatchListener
 *
 * @author Dave Meikle
 */
class PasswordMismatchListener extends AbstractListener{
    
    const MAX_LOGIN_FAILURES = 6;
    
    public function on_login_password_mismatch(array $params) {
       
        $client = $params['client'];
        $model = new UserModel($this->httpRequest, $this->httpResponse, $this->logger);
        $datasource = $this->getDatasource($model);
        $datasource->query("update UserAuthentications set failedLogins = failedLogins + 1 where username='" . $client->getCredentials() . "'");
        
        //now check to see if we need to lock them down
        $result = $datasource->query("select failedLogins from UserAuthentications  where username='" . $client->getCredentials() . "'");
        
        $failedLogins = current($result);
        $value = $failedLogins['failedLogins'];
        if($value >= self::MAX_LOGIN_FAILURES) {
            $datasource->query("update UserAuthentications set status='locked' where username='" . $client->getCredentials() . "'");
        }
        unset($datasource);
        unset($model);
    }
}
