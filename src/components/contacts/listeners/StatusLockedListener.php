<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace components\contacts\listeners;

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