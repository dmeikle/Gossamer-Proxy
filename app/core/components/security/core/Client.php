<?php

namespace core\components\security\core;

use core\components\security\core\ClientInterface;

/**
 * Description of User
 *
 * @author Dave Meikle
 */
class Client implements ClientInterface{
    
    protected $password = null;
    
    protected $roles = array();
    
    protected $credentials = 'anonymous';
    
    protected $ipAddress = null;
    
    protected $status = null;
    
    public function __construct(array $params = array()) {
        if(count($params) > 0) {
            $this->password = $params['password'];
            $this->status = $params['status'];
            $this->roles = $params['roles'];
            $this->credentials = (array_key_exists('credentials', $params))? $params['credentials'] : $params['username'];
            $this->ipAddress = (array_key_exists('ipAddress', $params))? $params['ipAddress'] : '';
        }
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function setRoles(array $roles) {
        $this->roles = $roles;
    }
    
    public function setCredentials($credentials) {
        $this->credentials = $credentials;
    }
    
    public function setIpAddress($ipAddress) {
        $this->ipAddress = $ipAddress;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getRoles() {
        return $this->roles;
    }
    
    public function getCredentials() {
        return $this->credentials;
    }
    
    public function getIpAddress() {
        return $this->ipAddress;
    }
    
    
    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function getStatus() {
        return $this->status;
    }
}
