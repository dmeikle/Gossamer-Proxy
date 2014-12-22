<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\components\security\core;

use core\components\security\core\AuthenticationManagerInterface;
use Monolog\Logger;
use core\services\ServiceInterface;
use core\components\security\core\SecurityToken;
use core\components\security\exceptions\ArgumentNotPassedException;
use core\components\security\exceptions\ClientCredentialsNotFoundException;
use libraries\utils\Container;
use core\eventlisteners\Event;

/**
 * Description of AuthenticationManager
 *
 * @author Dave Meikle
 */
class UserLoginManager implements AuthenticationManagerInterface, ServiceInterface
{
    protected $logger = null;
    
    protected $userAuthenticationProvider = null;
    
    protected $container = null;
    
    protected $node = null;
    
    protected $loggingIn = true;
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
    
    public function setContainer(Container $container) {
        $this->container = $container;
    }
 
    public function authenticate(SecurityContextInterface $context) {
      
        $token = $this->generateEmptyToken();
     
        $client = null;
        try{
          
            $client = $this->userAuthenticationProvider->loadClientByCredentials($token->getClient()->getCredentials());
        }catch(ClientCredentialsNotFoundException $e) {
            
            $this->logger->addAlert('Client not found ' . $e->getMessage());
            throw $e;
        }
 
        //validate the client, if good then add to the context
        if(!is_null($client)) {
           
           $eventParams = array('client' => $client);
            
            if(!$this->checkPasswordsMatch($client->getPassword(), $token->getClient()->getPassword())) {
                error_log('login_password_mismatch');
                $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'login_password_mismatch',  new Event('login_password_mismatch', $eventParams));               
            }
            if($this->statusIsLocked($client)) {
                error_log('login_status_locked');
                $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'login_status_locked', new Event('login_status_locked', $eventParams));
                setSession('_security_secured_area', null);
            }
            if(!$this->checkStatus($client)) {
                error_log('login_status_not_active');
                $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'login_status_not_active',  new Event('login_status_not_active', $eventParams));
            }
            if(!$this->checkRolesSet($client)) {
                error_log('login_roles_not_set');
                $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'login_roles_not_set',  new Event('login_roles_not_set', $eventParams));
            }
           
            $token->setClient($client);
        }
        
        $context->setToken($token);
        
        setSession('_security_secured_area', serialize($token));
        $this->container->set('securityContext', 'core\components\security\core\SecurityContext', $context);
        
        $eventParams = array('client' => $client);        
        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'login_success', new Event('login_success', $eventParams));
    }

    private function checkRolesSet(Client $client) {
       if(count($client->getRoles()) > 1) {
           return true;
       }
       
       $roles = $client->getRoles();
       
       return strlen($roles[0]) > 0;
    }
    
    private function statusIsLocked(Client $client) {
      
        return ($client->getStatus() == 'locked');
    }
    private function checkPasswordsMatch($clientPassword, $tokenPassword) {
       
        $result = (crypt($tokenPassword, $clientPassword) == $clientPassword);
       
        return $result;
    }
    
    private function checkStatus(Client $client) {
        return ($client->getStatus() == 'active');
    }
    
    public function execute() {
       // die('here in execute');
       //placeholder function since we need the ServiceInterface
    }

    public function setParameters(array $params) {
  
        if(!array_key_exists('user_authentication_provider', $params) && 
                !array_key_exists('staff_authentication_provider', $params)&& 
                !array_key_exists('contact_authentication_provider', $params) && 
                !array_key_exists('invite_authentication_provider', $params)) {
            throw new ArgumentNotPassedException('authentication_provider not specified in config');
        }
        if(array_key_exists('staff_authentication_provider', $params)) {
            $this->userAuthenticationProvider = $params['staff_authentication_provider'];
        } elseif (array_key_exists('contact_authentication_provider', $params)) {
            $this->userAuthenticationProvider = $params['contact_authentication_provider'];
        } elseif (array_key_exists('user_authentication_provider', $params)) {
           $this->userAuthenticationProvider = $params['user_authentication_provider']; 
        } else {
           $this->userAuthenticationProvider = $params['invite_authentication_provider']; 
        }
        
    }

    public function generateEmptyToken() {
       
        $client = $this->getClient();
        $token = new SecurityToken($client, __YML_KEY, $client->getRoles());
       
        return $token;
    }
    
    public function getClient() {
        
        $client = new Client();
        $client->setIpAddress($_SERVER['REMOTE_ADDR']);
        $client->setRoles(array('ROLE_ANONYMOUS_USER'));
        $client->setCredentials($this->getClientCredentials());
        $client->setPassword($this->getPassword());
      
        return $client;
    }
    
    protected function getClientCredentials() {
       
        if(array_key_exists('username', $_POST)) {
            return $_POST['username'];
        } elseif(array_key_exists('email', $_POST)) {
            return $_POST['email'];
        }
        
        //if all else fails check the headers
        return $this->getClientHeaderCredentials();
    }
    
    protected function getPassword() {
        if(array_key_exists('password', $_POST)) {
            
            return $_POST['password'];
        }
        
        return $this->getClientHeaderPassword();
    }
    
    protected function getClientHeaderPassword() {
        $headers = getallheaders();
        
        if(array_key_exists('password', $headers)) {
            return $headers['password'];
        }
        
        return null;
    }
    
    protected function getClientHeaderCredentials() {
        $headers = getallheaders();
        if(array_key_exists('credentials', $headers)) {
            return $headers['credentials'];
        }
        
        return null;
    }
}
