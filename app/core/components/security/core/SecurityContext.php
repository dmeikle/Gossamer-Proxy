<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\components\security\core;

/**
 * Description of SecurityContext
 *
 * @author Dave Meikle
 */
class SecurityContext implements SecurityContextInterface 
{
    private $token = null;
    
    public function getToken() {
        return $this->token;
    }

    final public function isGranted(mixed $attributes, mixed $object = null) {
        
    }

    public function setToken(TokenInterface $token) {
        $this->token = $token;
    }

 
}
