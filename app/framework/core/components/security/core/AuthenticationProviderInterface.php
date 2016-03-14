<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace core\components\security\core;

use core\components\security\core\ClientInterface;

/**
 * AuthenticationProviderInterface
 *
 * @author Dave Meikle
 */
interface AuthenticationProviderInterface {

    public function loadClientByCredentials($credential);

    public function refreshClient(ClientInterface $client);

    public function supportsClass($class);

    public function getRoles(ClientInterface $client);
}
