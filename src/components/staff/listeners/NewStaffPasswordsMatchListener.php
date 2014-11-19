<?php


namespace components\staff\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;

/**
 * Description of NewStaffPasswordsMatchListener
 *
 * @author davem
 */
class NewStaffPasswordsMatchListener extends AbstractListener{
    
    public function on_request_start(Event $event = null) {
       
        $post = $this->httpRequest->getPost();
        $staffData = $post['staff'];
       
        $errorResult = array();
        if($this->checkPasswordEmpty($staffData)) {
            $errorResult['password'] = 'VALIDATION_PASSWORD_REQUIRED';
        }elseif($this->checkPasswordsMismatch($staffData)) {
            $errorResult['password'] = 'VALIDATION_PASSWORD_MISMATCH';
        }elseif($this->invalidPasswordFormat($staffData)) {
            $errorResult['password'] = 'VALIDATION_PASSWORD_COMPLEXITY';
        }
     
        if(count($errorResult) > 0) {
            $failKey = $this->listenerConfig['params']['failkey'];  
            setSession('ERROR_RESULT', $errorResult);
            //TODO: make this lookup based on failkey
            header("Location: /admin/staff/edit/0");
            /* Make sure that code below does not get executed when we redirect. */
            exit;
        }
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
}
