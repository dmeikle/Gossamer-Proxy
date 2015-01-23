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
use core\system\Router;

/**
 * Description of NewStaffPasswordsMatchListener
 *
 * @author Dave Meikle
 */
class StaffPasswordValidListener extends AbstractListener{
    
    public function on_entry_point(Event $event = null) {
     
        $post = $this->httpRequest->getPost();
        $staffData = $post['StaffAuthorization'];
       
        $result = array();
        if($this->checkPasswordEmpty($staffData)) {
            $result['password'] = 'VALIDATION_PASSWORD_REQUIRED';
        }elseif($this->checkPasswordsMismatch($staffData)) {
            $result['password'] = 'VALIDATION_PASSWORD_MISMATCH';
        }elseif($this->invalidPasswordFormat($staffData)) {
            $result['password'] = 'VALIDATION_PASSWORD_COMPLEXITY';
        }
    
        if(is_array($result) && count($result) > 0) {
        
            setSession('ERROR_RESULT', $this->formatErrorResult($result));
            setSession('POSTED_PARAMS', $this->formatPostedArrayforFramework());
            
            $router = new Router($this->logger, $this->httpRequest);
            $router->redirect($this->listenerConfig['params']['failkey']);
        }
       
        setSession('ERROR_RESULT', null);
        setSession('POSTED_PARAMS', NULL);
    }
    
    private function checkPasswordEmpty(array $staffData) {
        return strlen($staffData['password']) == 0;
    }
    
    private function checkPasswordsMismatch(array $staffData) {
        return $staffData['password'] != $staffData['passwordConfirm'];
    }
    
    private function invalidPasswordFormat(array $staffData) {
         return (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $staffData['password']));
    }
    private function formatErrorResult(array $result) {
        return array (
            'StaffAuthorization' => $result
        );
    }
    
    private function formatPostedArrayforFramework() {
       $retval = array();
       $key = key($this->httpRequest->getPost());
       $retval[$key][] = current($this->httpRequest->getPost());
       
       return $retval;
   }
}
