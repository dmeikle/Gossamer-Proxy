<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace components\staff\providers;

use core\components\security\core\AuthenticationProviderInterface;
use core\components\security\core\ClientInterface;
use core\datasources\DatasourceAware;
use core\components\security\core\Client;
use core\components\security\exceptions\ClientCredentialsNotFoundException;
use core\components\security\providers\UserAuthenticationProvider;

/**
 * Authenticates all admin staff logging in
 *
 * @author Dave Meikle
 */
class StaffAuthenticationProvider extends UserAuthenticationProvider implements AuthenticationProviderInterface {

    /**
     * 
     * @param type $credential
     * @return Client
     * 
     * @throws ClientCredentialsNotFoundException
     */
    public function loadClientByCredentials($credential) {
       
        $model = new \components\staff\models\StaffModel($this->container->get('HTTPRequest'), $this->container->get('HTTPResponse'), $this->container->get('Logger'));
        $params = array(
            'username' => $credential
        );
        $result = $this->datasource->query('GET', $model, 'login', $params);


        if ($result && array_key_exists('StaffAuthorization', $result)) {
            $client = current($result['StaffAuthorization']);
            $client['ipAddress'] = $this->getClientIp();

            return new Client($client);
        }

        throw new ClientCredentialsNotFoundException('no user found with credential ' . $credential);
    }
    
    public function loadClientByCredentialsLocal($credential) {

        $result = $this->datasource->query(sprintf("select * from StaffAuthorizations where username = '%s' limit 1", $credential));

        if ($result) {
            $client = current($result);
            $client['ipAddress'] = $this->getClientIp();

            return new Client($client);
        }

        throw new ClientCredentialsNotFoundException('no user found with credential ' . $credential);
    }

    /**
     * 
     * @param ClientInterface $client
     * 
     * @return array
     */
    public function getRoles(ClientInterface $client) {
        
        $result = $this->datasource->query("select role from AccessRoles where Staff_id = '%d'", $client->getId());

        return $result;
    }

    public function refreshClient(ClientInterface $client) {
        
    }

    public function supportsClass($class) {
        
    }

    public function execute() {
        
    }

}
