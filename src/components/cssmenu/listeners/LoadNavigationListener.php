<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\cssmenu\listeners;

use core\components\access\eventlisteners\LoadNavigationListener as BaseListener;

/**
 * LoadNavigationListener - Loads the navigation config for a user
 * to determine their available menu options
 *
 * @author Dave Meikle
 */
class LoadNavigationListener extends BaseListener {

 
    /**
     * returns the specified user access roles for a current user.
     * the rest of the logic is abstracted into the parent class
     * 
     * @return array
     */
    protected function getUserAccessRoles() {
      
        $roles = $this->httpRequest->getAttribute('ROLES');
        
        if (!is_array($roles) || count($roles) == 0) {
            return array('IS_ANONYMOUS');
        }

        return $roles;
    }

}
