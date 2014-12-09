<?php

namespace core\components\security\core;

use core\components\security\core\ClientInterface;

/**
 *
 * @author davem
 */
interface AuthorizationProviderInterface {
    
    public function setClient(ClientInterface $client);
    
    public function isAuthorized();
}
