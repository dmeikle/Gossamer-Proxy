<?php

namespace core\components\security\http\firewall;

use core\components\security\core\SecurityContextInterface;
use core\components\security\core\AuthenticationManager;

/**
 * Description of FirewallInterface
 *
 * @author Dave Meikle
 */
interface AuthorizationInterface {
    
    public function __construct(SecurityContextInterface $context, AuthenticationManager $manager);
    
}
