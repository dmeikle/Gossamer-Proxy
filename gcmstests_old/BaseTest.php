<?php

namespace gcmstests;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class BaseTest extends \PHPUnit_Framework_TestCase
{

    const GET = 'GET';
    const POST = 'POST';

    private $container = null;

    protected function getHttpRequest($uri, array $requestParams = array(), $requestMethod) {
        $_SERVER['REQUEST_METHOD'] = $requestMethod;
        $_SERVER['REQUEST_URI'] = $uri;
        $_SERVER['REMOTE_ADDR'] = '1.2.3.4';
        $request = new \core\http\HTTPRequest(true, $requestParams);

        return $request;
    }

    protected function getLogger() {

        $logger = new Logger('phpUnitTest');
        $logger->pushHandler(new StreamHandler(__SITE_PATH . "/logs/phpunit.log", Logger::DEBUG));


        return $logger;
    }

    public function setRequestMethod($method) {
        define("__REQUEST_METHOD", $method);
    }

    public function setURI($uri) {
        define('__URI', $uri);
        define("__REQUEST_URI", $uri . '/');
    }

    public function getDBConnection() {

        $conn = new \Gossamer\Pesedget\Database\DBConnection($this->getCredentials());

        return $conn;
    }

    protected function getCredentials() {
        $credentials = array();
        $credentials['host'] = 'localhost';
        $credentials['username'] = 'bh_user';
        $credentials['password'] = 'eyeH3aR2GS';
        $credentials['dbName'] = 'BHDB5_master';

        return $credentials;
    }

    protected function getContainer() {
        if (is_null($this->container)) {
            $this->container = new \libraries\utils\Container();
            //instantiate the database entity manager            
            $this->container->set('EntityManager', 'Gossamer\Pesedget\Database\EntityManager', EntityManager::getInstance());
        }


        return $this->container;
    }
}
