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

use core\components\security\core\AuthenticationManagerInterface;
use Monolog\Logger;
use core\services\ServiceInterface;
use core\components\security\core\SecurityToken;
use core\components\security\exceptions\ArgumentNotPassedException;
use core\components\security\exceptions\ClientCredentialsNotFoundException;
use libraries\utils\Container;
use core\eventlisteners\Event;

/**
 * determines if a user is logged in based on firewall configuration
 *
 * @author Dave Meikle
 */
class UserLoginManager implements AuthenticationManagerInterface, ServiceInterface {

    protected $logger = null;
    protected $userAuthenticationProvider = null;
    protected $container = null;
    protected $node = null;
    protected $loggingIn = true;

    /**
     *
     * @param Logger $logger
     */
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    /**
     * accessor
     *
     * @param Container $container
     */
    public function setContainer(Container $container) {
        $this->container = $container;
    }

    /**
     * authenticates a user based on their context
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

    /**
     * checks to ensure a client's roles are known
     *
     * @param \core\components\security\core\Client $client
     * @return boolean
     */
    protected function checkRolesSet(Client $client) {
        if (count($client->getRoles()) > 1) {
            return true;
        }

        $roles = $client->getRoles();

        return strlen($roles[0]) > 0;
    }

    /**
     * check if a client account is locked
     *
     * @param \core\components\security\core\Client $client
     *
     * @return boolean
     */
    protected function statusIsLocked(Client $client) {

        return ($client->getStatus() == 'locked');
    }

    /**
     * check if the passwords match
     *
     * @param type $clientPassword
     * @param type $tokenPassword
     *
     * @return boolean
     */
    protected function checkPasswordsMatch($clientPassword, $tokenPassword) {

        $result = (crypt($tokenPassword, $clientPassword) == $clientPassword);

        return $result;
    }

    /**
     * check a user's status
     *
     * @param \core\components\security\core\Client $client
     *
     * @return boolean
     */
    protected function checkStatus(Client $client) {
        return ($client->getStatus() == 'active');
    }

    /**
     * placeholder function since we need the ServiceInterface
     */
    public function execute() {

    }

    /**
     * accessor
     *
     * @param array $params
     *
     * @throws ArgumentNotPassedException
     */
    public function setParameters(array $params) {

        if (!array_key_exists('user_authentication_provider', $params) &&
                !array_key_exists('staff_authentication_provider', $params) &&
                !array_key_exists('contact_authentication_provider', $params) &&
                !array_key_exists('invite_authentication_provider', $params)) {
            throw new ArgumentNotPassedException('authentication_provider not specified in config');
        }
        if (array_key_exists('staff_authentication_provider', $params)) {
            $this->userAuthenticationProvider = $params['staff_authentication_provider'];
        } elseif (array_key_exists('contact_authentication_provider', $params)) {
            $this->userAuthenticationProvider = $params['contact_authentication_provider'];
        } elseif (array_key_exists('user_authentication_provider', $params)) {
            $this->userAuthenticationProvider = $params['user_authentication_provider'];
        } else {
            $this->userAuthenticationProvider = $params['invite_authentication_provider'];
        }

        //pr($this->userAuthenticationProvider);
    }

    /**
     * generates a new empty token
     *
     * @return SecurityToken
     */
    public function generateEmptyToken() {

        $client = $this->getClient();
        $token = new SecurityToken($client, __YML_KEY, $client->getRoles());

        return $token;
    }

    /**
     *
     * @return \core\components\security\core\Client
     */
    public function getClient() {

        $client = new Client();
        $client->setIpAddress($_SERVER['REMOTE_ADDR']);
        $client->setRoles(array('ROLE_ANONYMOUS_USER'));
        $client->setCredentials($this->getClientCredentials());
        $client->setPassword($this->getPassword());

        return $client;
    }

    /**
     * accessor
     *
     * @return array
     */
    protected function getClientCredentials() {

        if (array_key_exists('username', $_GET)) {
            return $_GET['username'];
        } elseif (array_key_exists('email', $_GET)) {
            return $_GET['email'];
        }

        //if all else fails check the headers
        return $this->getClientHeaderCredentials();
    }

    /**
     * accessor
     *
     * @return string
     */
    protected function getPassword() {
        if (array_key_exists('password', $_POST)) {

            return $_POST['password'];
        }

        return $this->getClientHeaderPassword();
    }

    /**
     * accessor
     *
     * @return string|null
     */
    protected function getClientHeaderPassword() {
        $headers = getallheaders();

        if (array_key_exists('password', $headers)) {
            return $headers['password'];
        }

        return null;
    }

    /**
     * accessor
     *
     * @return string
     */
    protected function getClientHeaderCredentials() {
        $headers = getallheaders();
        if (array_key_exists('credentials', $headers)) {
            return $headers['credentials'];
        }

        return null;
    }

}
