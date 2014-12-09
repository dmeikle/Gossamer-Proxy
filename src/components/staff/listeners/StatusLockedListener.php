<?php


namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;

/**
 * Description of StatusLockedListener
 *
 * @author Dave Meikle
 */
class StatusLockedListener extends AbstractListener{
    
    const MAX_LOGIN_FAILURES = 6;
    
    public function on_login_status_locked(array $params) {
       
        die('user is locked');
    }
}