<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

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
