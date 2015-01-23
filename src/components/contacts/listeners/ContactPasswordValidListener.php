<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\contacts\listeners;

use core\eventlisteners\AbstractListener;
use core\eventlisteners\Event;
use core\system\Router;

/**
 * Description of ContactPasswordValidListener
 *
 * @author Dave Meikle
 */
class ContactPasswordValidListener extends AbstractListener{
    
    public function on_entry_point(Event $event = null) {
     
        $post = $this->httpRequest->getPost();
        $contactData = $post['ContactAuthorization'];
       
        $result = array();
        if($this->checkPasswordEmpty($contactData)) {
            $result['password'] = 'VALIDATION_PASSWORD_REQUIRED';
        }elseif($this->checkPasswordsMismatch($contactData)) {
            $result['password'] = 'VALIDATION_PASSWORD_MISMATCH';
        }elseif($this->invalidPasswordFormat($contactData)) {
            $result['password'] = 'VALIDATION_PASSWORD_COMPLEXITY';
        }
 
        if(is_array($result) && count($result) > 0) {
     
            setSession('ERROR_RESULT', $this->formatErrorResult($result));
            setSession('POSTED_PARAMS', $this->formatPostedArrayforFramework());
       
            $params = $this->httpRequest->getParameters();
            $id = $params[0];
           
            $router = new Router($this->logger, $this->httpRequest);
            $router->redirect($this->listenerConfig['params']['failkey'], array($id));
            
        }
       
        setSession('ERROR_RESULT', null);
        setSession('POSTED_PARAMS', NULL);
  
    }
    
    private function checkPasswordEmpty(array $contactData) {
        return strlen($contactData['password']) == 0;
    }
    
    private function checkPasswordsMismatch(array $contactData) {
        return $contactData['password'] != $contactData['passwordConfirm'];
    }
    
    private function invalidPasswordFormat(array $contactData) {
         return (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $contactData['password']));
    }
    private function formatErrorResult(array $result) {
        return array (
            'ContactAuthorization' => $result
        );
    }
    
    private function formatPostedArrayforFramework() {
       $retval = array();
       $key = key($this->httpRequest->getPost());
       $retval[$key][] = current($this->httpRequest->getPost());
       
       return $retval;
   }
}
