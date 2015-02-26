<?php


namespace core\components\security\core;

use core\components\security\core\SecurityContextInterface;

/**
 * Description of AuthenticationManagerInterface
 *
 * @author Dave Meikle
 */
interface AuthenticationManagerInterface {
   
    public function authenticate(SecurityContextInterface $context);//(TokenInterface $token);
    
    
    public function generateEmptyToken() ;
    
    public function getClient();
}
