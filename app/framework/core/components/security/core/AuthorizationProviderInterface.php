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
 * AuthorizationProviderInterface
 * 
 * @author Dave Meikle
 */
interface AuthorizationProviderInterface {

    public function setClient(ClientInterface $client);

    public function isAuthorized();
}
