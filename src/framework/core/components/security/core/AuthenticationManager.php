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


/**
 * Description of AuthenticationManager
 *
 * @author Dave Meikle
 */
class AuthenticationManager implements AuthenticationManagerInterface, ServiceInterface
{
    protected $logger = null;
    
    protected $userAuthenticationProvider = null;
    
    protected $container = null;
    
    protected $node = null;
    public function __construct(Logger $logger) {
        $this->logger = $logger;
       
    }
    
    public function setContainer(Container $container) {
        $this->container = $container;
    }
 
    public function authenticate(SecurityContextInterface $context) {
     
        $token = $this->generateEmptyToken();
    
        try{

            $this->userAuthenticationProvider->loadClientByCredentials($token->getClient()->getCredentials());
           
        }catch(ClientCredentialsNotFoundException $e) {
            $this->logger->addAlert('Client not found ' . $e->getMessage());
            throw $e;
        }
        //validate the client, if good then add to the context
        if(true) {
            $context->setToken($token);
        }
    }

    public function execute() {
       //placeholder function since we need the ServiceInterface
    }

    public function setParameters(array $params) {
   
        if(!array_key_exists('user_authentication_provider', $params)) {
            throw new ArgumentNotPassedException('user_authentication_provider not specified in config');
        }
        
        $this->userAuthenticationProvider = $params['user_authentication_provider'];
    }

    public function generateEmptyToken() {
        
        $token = unserialize(getSession('_security_secured_area'));
   
        if(!$token) {
            return $this->generateNewToken();
        }
        
        return $token;
    }
    
    public function generateNewToken() {
        $client = $this->getClient();
        $token = new SecurityToken($client, __YML_KEY, $client->getRoles());
       
        return $token;
    }
    
    public function getClient() {
        $client = new Client();
        $client->setIpAddress($_SERVER['REMOTE_ADDR']);
        $client->setRoles(array('ROLE_ANONYMOUS_USER'));
        $client->setCredentials($this->getClientHeaderCredentials());
        
        return $client;
    }
    
    
    protected function getClientHeaderCredentials() {
        $headers = getallheaders();
        if(array_key_exists('credentials', $headers)) {
            return $headers['credentials'];
        }
        
        return null;
    }
}
