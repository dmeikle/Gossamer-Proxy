<?php

namespace core\components\security\core;

use core\components\security\core\TokenInterface;
use core\components\security\core\Client;

/**
 * Description of SecurityToken
 *
 * @author Dave Meikle
 */
class SecurityToken  implements TokenInterface{
    
    private $client = null;
    
    private $identity = null;
    
    private $roles = null;
    
    private $isAuthenticated = false;
    
    private $attributes = array();
    
    private $ymlKey = null;
    
    public function __construct(Client $client, $ymlKey, array $roles = array()) {
        $this->client = $client;
        $this->ymlKey = $ymlKey;
        $this->roles = $roles;
    }
    

    public function eraseCredentials() {
        
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function getClient() {
        return $this->client;
    }

    public function getIdentity() {
        return $this->identity;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function isAuthenticated() {
        return $this->isAuthenticated;
    }

    public function setIdentity($identity) {
        $this->identity = $identity;
    }
    public function setAttribute($name, mixed $value) {
        $this->attributes[$name] = $value;
    }

    public function setAttributes(array $attributes) {
        $this->attributes = $attributes;
    }

    public function setAuthenticated($isAuthenticated) {
        $this->isAuthenticated = $isAuthenticated;
    }

    public function setClient(Client $client) {
        $this->client = $client;
    }

    public function toString() {
        
    }

}
