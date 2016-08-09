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

use core\components\security\exceptions\ClientCredentialsNotFoundException;
use core\eventlisteners\Event;

/**
 * UserLoginAPIManager
 *
 * @author Dave Meikle
 */
class UserLoginAPIManager extends UserLoginManager {

    /**
     * authenticates a user based on their context. used for API servers that
     * track clients logged in to other HTML servers upline.
     *
     * @param \core\components\security\core\SecurityContextInterface $context
     *
     * @throws ClientCredentialsNotFoundException
     */
    public function authenticate(SecurityContextInterface $context) {

        $token = $this->generateEmptyToken();

        $client = null;
        try {

            $client = $this->userAuthenticationProvider->loadClientByCredentials($token->getClient()->getCredentials());
        } catch (ClientCredentialsNotFoundException $e) {

            $this->logger->addAlert('Client not found ' . $e->getMessage());
            throw $e;
        }

        //validate the client, if good then add to the context
        if (!is_null($client)) {

            $eventParams = array('client' => $client);

            //since we want to know WHY a person was not allowed, run each check individually
            if ($this->statusIsLocked($client)) {

                $this->logger->addAlert('login_status_locked');
                $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'login_status_locked', new Event('login_status_locked', $eventParams));

                setSession('_security_secured_area', null);
            }

            if (!$this->checkPasswordsMatch($client->getPassword(), $token->getClient()->getPassword())) {
                $this->logger->addAlert('login_password_mismatch');
                echo $client->getPassword() . ' ' . $token->getClient()->getPassword() . '<br>';
                echo __YML_KEY;
                echo (' mismatch<br>');
                $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'login_password_mismatch', new Event('login_password_mismatch', $eventParams));
            }

            if (!$this->checkStatus($client)) {
                $this->logger->addAlert('login_status_not_active');
                $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'login_status_not_active', new Event('login_status_not_active', $eventParams));
            }
            if (!$this->checkRolesSet($client)) {
                $this->logger->addAlert('login_roles_not_set');
                $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'login_roles_not_set', new Event('login_roles_not_set', $eventParams));
            }

            $token->setClient($client);
        }

        $context->setToken($token);

        setSession('_security_secured_area', serialize($token));
        $this->container->set('securityContext', 'core\components\security\core\SecurityContext', $context);

        $eventParams = array('client' => $client);

        $this->container->get('EventDispatcher')->dispatch(__YML_KEY, 'login_success', new Event('login_success', $eventParams));
    }

}
