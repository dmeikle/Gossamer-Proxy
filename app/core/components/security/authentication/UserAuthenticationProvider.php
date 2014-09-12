<?php

namespace core\components\security\authentication;

use core\components\security\core\AuthenticationProviderInterface;
use core\components\security\core\ClientInterface;
use core\datasources\DatasourceAware;
use core\components\security\core\Client;
use core\components\security\exceptions\ClientCredentialsNotFoundException;


/**
 * Description of UserAuthenticationProvider
 *
 * @author Dave Meikle
 */
class UserAuthenticationProvider extends DatasourceAware implements AuthenticationProviderInterface{
    
    public function loadClientByCredentials($credential) {
     
        $result = $this->datasource->query(sprintf("select * from UserAuthentications where username = '%s' limit 1", $credential));
        
        if($result) {
            return new Client(current($result));
        }
       
        throw new ClientCredentialsNotFoundException('no user found with credential ' . $credential);
    }

    public function refreshClient(ClientInterface $client) {
        return $this->loadClientByCredentials($client->getCredentials());
    }

    public function supportsClass($class) {
        return $class === 'core\components\security\core\Client';
    }

}
