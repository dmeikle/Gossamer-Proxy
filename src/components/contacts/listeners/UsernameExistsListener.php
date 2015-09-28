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
use components\contacts\models\ContactAuthorizationModel;
use core\system\Router;


/**
 * Description of UsernameExistsListener
 *
 * @author Dave Meikle
 */
class UsernameExistsListener extends AbstractListener{
    
    public function on_request_start(Event $event = null) {
       
        $contact = new ContactAuthorizationModel($this->httpRequest, $this->httpResponse, $this->logger);
        $post = $this->httpRequest->getPost();
        $contactData = $post['ContactAuthorization'];
        $uriParams = $this->httpRequest->getParameters();
        $params = array('username'=> $contactData['username']);
        $currentContactId = $this->getLoggedInStaffId();
        
        $datasource = $this->getDatasource('components\staff\models\ContactAuthorizationModel');
  
        $results = $datasource->query('get', $contact, 'get', $params);
     
        if(is_array($results) && array_key_exists('ContactAuthorization', $results) && $this->isDifferentUser($currentContactId, $results)) {
           
            setSession('ERROR_RESULT', $this->formatErrorResult());
            setSession('POSTED_PARAMS', $this->formatPostedArrayforFramework());
            
            $router = new Router($this->logger, $this->httpRequest);
            $router->redirect($this->listenerConfig['params']['failkey']);
        }
   
        setSession('ERROR_RESULT', null);
        setSession('POSTED_PARAMS', NULL);
    }
    
    private function isDifferentUser($currentId, array $result) {
        $results = current($result['ContactAuthorization']);
        
        return (intval($currentId) != $results['Contacts_id']);
    }
    
    private function formatErrorResult() {
        return array (
            'ContactAuthorization' => array('username' => 'VALIDATION_USERNAME_EXISTS')
        );
    }
    
    private function formatPostedArrayforFramework() {
       $retval = array();
       $key = key($this->httpRequest->getPost());
       $retval[$key][] = current($this->httpRequest->getPost());
       
       return $retval;
   }
}
