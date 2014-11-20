<?php


namespace core\components\security\core;

/**
 * Description of FormToken
 *
 * @author davem
 */
class FormToken implements FormTokenInterface{
    
    protected $ipAddress;
    
    protected $tokenString;
    
    protected $tokenTimestamp;
    
    protected $credentials;
    
    protected $clientId;
    
    public function __construct(Client $client) {
        $this->tokenTimestamp = time();
        $this->setCredentials($client->getCredentials());
        $this->setIPAddress($client->getIpAddress());
        $this->setClientId($client->getId());
    }
    
    public function setIPAddress($ipAddress) {
        $this->ipAddress = $ipAddress;
    }

    public function setTokenString($token) {
        $this->token = $token;
    }

    public function getTimestamp() {
        return $this->tokenTimestamp;
    }

    public function toString() {
        return $this->ipAddress . '|' . $this->credentials . '|' . $this->clientId;
    }
    
    public function setCredentials($credentials) {
        $this->credentials = $credentials;
    }
    
    
    public function setClientId($id) {
        $this->clientId = $id;
    }

    public function generateTokenString() {
        $this->tokenString = crypt($this->toString());
        
        return $this->tokenString;
    }
    
    public function getTokenString() {
        return $this->tokenString;
    }
}
