<?php

namespace core\components\security\providers;

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
class StaffAuthenticationProvider extends UserAuthenticationProvider implements AuthenticationProviderInterface
{
    
    public function loadClientByCredentials($credential) {
    
        $result = $this->datasource->query(sprintf("select * from StaffAuthorizations where username = '%s' limit 1", $credential));
      
       
        if($result) {
            $client = current($result);
            $client['ipAddress'] = $this->getClientIp();
            
            return new Client($client);
        }
       
        throw new ClientCredentialsNotFoundException('no user found with credential ' . $credential);
    }



    public function getRoles(ClientInterface $client) {
        $result = $this->datasource->query("select role from AccessRoles where Staff_id = '%d'", $client->getId());
        
        return $result;
    }
    
    
}
