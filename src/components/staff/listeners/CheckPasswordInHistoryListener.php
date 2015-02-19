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
use core\eventlisteners\Event;
use components\users\lib\Password;
use core\system\Router;

/**
 * 
 * @requires: LoadStaffListener called first to make loaded Staff available
 *
 * @author Dave Meikle
 */
class CheckPasswordInHistoryListener extends AbstractListener{
    
    public function on_entry_point(Event $event = null) {
      
        $params = $this->httpRequest->getPost();
       
        $member = $this->httpRequest->getAttribute('components\\staff\\models\\StaffAuthorizationModel');
     
        
        $password = new Password();
        if($password->checkPasswordExists($params['StaffAuthorization']['password'], $member['passwordHistory'])) {
            setSession('ERROR_RESULT', array ('StaffAuthorization' => array('password' => 'VALIDATION_PASSWORD_IN_HISTORY')));
            setSession('POSTED_PARAMS', $this->formatPostedArrayforFramework());
            
            $router = new Router($this->logger, $this->httpRequest);
            $router->redirect($this->listenerConfig['params']['failkey'], array($member['Staff_id']));
        }
        unset($password);
        
    }
    
    
    private function formatPostedArrayforFramework() {
       $retval = array();
       $key = key($this->httpRequest->getPost());
       $retval[$key][] = current($this->httpRequest->getPost());
       
       return $retval;
   }
}
