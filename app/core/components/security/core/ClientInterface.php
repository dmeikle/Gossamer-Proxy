<?php

namespace core\components\security\core;

/**
 * Description of ClientInterface
 *
 * @author Dave Meikle
 */
interface ClientInterface {
   public function setPassword($password);
    
    public function setRoles(array $roles);
    
    public function setCredentials($credentials);
    
    public function setIpAddress($ipAddress);
    
    public function getPassword() ;
    
    public function getRoles() ;
    
    public function getCredentials() ;
    
    public function getIpAddress();
    
    public function setStatus($status);
    
    public function getStatus();
}
