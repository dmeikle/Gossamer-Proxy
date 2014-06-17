
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once('includes/configuration.php');
include_once('vendor/autoload.php');
include_once('includes/init.php');

use core\eventlisteners\EventDispatcher;
use core\http\HTTPRequest;
use core\http\HTTPResponse;

//$dispatcher = new EventDispatcher(array(), $logger);
//$container->set('eventdispatcher',null, $dispatcher);

$httpRequest = new HTTPRequest();
$httpResponse = new HTTPResponse();

 
                   
            $cmd = new $componentName($controllerName, $viewName, $modelName, $method,$httpRequest->getParameters(), $logger);  
            $cmd->setContainer($container);
              
            return $cmd->handleRequest($httpRequest, $httpResponse);