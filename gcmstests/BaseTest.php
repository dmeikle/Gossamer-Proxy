<?php

namespace gcmstests;

use core\datasources\DBConnection;
use core\datasources\DBConnectionAdapter;
use core\datasources\RestDataSource;
use core\views\JSONView;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Gossamer\Pesedget\Database\EntityManager;
use core\eventlisteners\EventDispatcher;


class BaseTest extends \PHPUnit_Framework_TestCase {

    const GET = 'GET';
    const POST = 'POST';

    private $container = null;

    protected function getHttpRequest($uri, $requestParams = '', $requestMethod) {
        $_SERVER['REQUEST_METHOD'] = $requestMethod;
        $_SERVER['REQUEST_URI'] = $uri;
        $_SERVER['REMOTE_ADDR'] = '1.2.3.4';
        $_SERVER['QUERY_STRING'] = $requestParams;

        $this->setURI($uri);
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
        if(!defined('__URI')) {
            define('__URI', $uri);
        }
        if(!defined('__REQUEST_URI')) {
            define("__REQUEST_URI", $uri . '/');
        }

    }

    public function getDBConnection() {

        $conn = new \Gossamer\Pesedget\Database\DBConnection($this->getCredentials());

        return $conn;
    }


    protected function getRestConnection($datasourceKey){

        $rest = new RestDataSource($this->getLogger());
        $rest->setDatasourceKey($datasourceKey);
        return $rest;
    }

    protected function getCredentials() {
        $credentials = array();
        $credentials['host'] = 'localhost';
        $credentials['username'] = 'bh_user';
        $credentials['password'] = 'eyeH3aR2GS';
        $credentials['dbName'] = 'BHDB5_master';

        return $credentials;
    }

    protected function getContainer($httpRequest, $httpResponse) {
        if(is_null($this->container )) {
            $this->container = new \libraries\utils\Container();

            //instantiate the database entity manager
            $this->container->set('EntityManager', 'Gossamer\Pesedget\Database\EntityManager', EntityManager::getInstance());

            $eventDispatcher = new EventDispatcher(null, $this->getLogger(), $httpRequest, $httpResponse);
            $this->container->set('EventDispatcher', 'core\eventlisteners\EventDispatcher', $eventDispatcher);
        }

        return $this->container;
    }

    protected function getView($ymlKey, $request, $response) {
        $array = array();
        $logger = $this->getLogger();

        $view = new PHPUnitView($logger,$ymlKey,$array,$request, $response);
        $view->setContainer($this->getContainer($request,$response));

        return $view;
    }

}
