<?php

namespace core\components\security\authentication;

use core\components\security\core\SecurityToken;

/**
 * Description of UsernamePasswordToken
 *
 * @author Dave Meikle
 */
class UsernamePasswordToken extends SecurityToken
{
    private $password = null;
    
    public function __construct($client, $password, $ymlKey, array $roles = array()) {
        parent::__construct($client, $ymlKey, $roles);
        $this->password = $password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getPassword() {
        return $this->password;
    }
}
