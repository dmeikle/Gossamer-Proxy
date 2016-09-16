<?php
/**
 * Created by PhpStorm.
 * User: dave
 * Date: 9/10/2016
 * Time: 11:27 AM
 */

namespace core\components\security\core;


use core\components\security\exceptions\ArgumentNotPassedException;
use core\components\security\exceptions\ServerCredentialsNotFoundException;
use core\components\security\exceptions\UnAuthorizedRequestException;
use core\services\ServiceInterface;
use libraries\utils\Container;
use Monolog\Logger;

class AuthorizationManager implements AuthorizationManagerInterface, ServiceInterface
{
    use \core\components\security\traits\QueryStringParametersTrait;
    
    private $logger = null;

    private $container;

    private $authorizationProvider = null;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function authorize(SecurityContextInterface $context)
    {
        $token = $this->generateEmptyToken();

        try {
            $server = $this->authorizationProvider->loadServerByCredentials($token->getClient()->getCredentials());
            $authorized = $this->authorizationProvider->isAuthorized($server, $this->getMemberId());

            if(!$authorized) {
                throw new UnAuthorizedRequestException('Request is unauthorized', 401);
            }
        } catch (ServerCredentialsNotFoundException $e) {

            $this->logger->addAlert('Server not found ' . $e->getMessage());
            throw $e;
        }
 
        //validate the client, if good then add to the context
        if (true) {
            $context->setToken($token);
        }
    }

    public function generateEmptyToken()
    {
        $token = unserialize(getSession('_security_secured_area'));

        if (!$token) {
            return $this->generateNewToken();
        }

        return $token;
    }

    /**
     * generates a new token based on current server
     *
     * @return SecurityToken
     */
    public function generateNewToken() {
        $server = $this->getServer();
        $token = new SecurityToken($server, __YML_KEY, $server->getRoles());
        $server->setCredentials($this->getServerApiKey());
        return $token;
    }

    public function getServer()
    {
        $server = new Server();
        $server->setIpAddress($_SERVER['REMOTE_ADDR']);
        $server->setApiKey($this->getServerApiKey());

        return $server;
    }

    private function getServerApiKey() {
        $headers = getallheaders();
        if (array_key_exists('apikey', $headers)) {
            return $headers['apikey'];
        }

        return $this->getQueryStringParameter('apikey');
    }

    private function getMemberId() {

        $segments = explode('/', __URI);
        array_shift($segments);
        //for now, we're only processing a uri of /members/memberID/reports/
        return array_shift($segments);
    }


    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    public function setParameters(array $params)
    {

        if (!array_key_exists('api3_authorization_provider', $params)) {
            throw new ArgumentNotPassedException('authorization provider not specified in config');
        }

        $this->authorizationProvider = $params['api3_authorization_provider'];
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }
}