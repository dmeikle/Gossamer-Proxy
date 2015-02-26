<?php


namespace core\components\security\core;

use core\components\security\core\ClientInterface;

/**
 * Description of AuthenticationProviderInterface
 *
 * @author Dave Meikle
 */
interface AuthenticationProviderInterface {
    
    public function loadClientByCredentials($credential);
    
    public function refreshClient(ClientInterface $client);
    
    public function supportsClass($class);
    
    public function getRoles(ClientInterface $client);
    
}
