<?php


namespace core\components\security\core;

/**
 *
 * @author davem
 */
interface FormTokenInterface {
    
    public function setIPAddress($ipAddress);
    
    public function setTokenString($token);
        
    public function toString();
    
    public function getTimestamp();
    
    public function setCredentials($credentials);
    
    public function setClientId($id);
    
    public function generateTokenString();
    
    public function getTokenString();
    
}
