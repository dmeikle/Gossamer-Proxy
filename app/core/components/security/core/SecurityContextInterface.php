<?php

namespace core\components\security\core;

use core\components\security\core\TokenInterface;

/**
 * Description of SecurityContextInterface
 *
 * @author Dave Meikle
 */
interface SecurityContextInterface {
    
    public function getToken();
    
    public function setToken(TokenInterface $token);
    
    public function isGranted(mixed $attributes, mixed $object = null);
}
