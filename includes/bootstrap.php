<?php
use libraries\utils\YAMLConfiguration2;
use libraries\utils\YAMLParser;
use Monolog\Logger;
use core\AbstractComponent;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use core\datasources\DatasourceFactory;
use core\eventlisteners\EventDispatcher;

$logger = new Logger('namespace');
$langFilesList = array();
$configuration = new YAMLConfiguration2($logger);
$nodeConfig = $configuration->getNodeParameters($_SERVER['REQUEST_URI']);


$controllerNode = $nodeConfig['defaults'];
$controllerNode['pattern'] = $nodeConfig['pattern'];

define('__YML_KEY', $nodeConfig['ymlKey']);  
define('__VIEW_KEY', $controllerNode['viewKey']);
define('__COMPONENT_FOLDER', $nodeConfig['componentFolder']);
define('__NAMESPACE', $nodeConfig['namespace']);

$datasources = $container->get('datasources', array());
//set the datasource for this model based on its current key
$datasources[$controllerNode['model']] = $controllerNode['datasource'];
$container->set('datasources', 'array', $datasources);
//set the datasource element now so we can call it throughout seamlessly
$container->set('datasourceFactory','core\datasources\DatasourceFactory');

$container->set('nodeConfig', null, $nodeConfig);
$container->set('controllerNode', null, $controllerNode);
$httpRequest =  new HTTPRequest($_REQUEST, $controllerNode['pattern']);

$httpResponse = new HTTPResponse();
$eventDispatcher = new EventDispatcher(null, $container->get('Logger'), $httpRequest, $httpResponse);
$eventDispatcher->setDatasources($container->get('datasourceFactory'), $datasources);

$controllerNode = $container->get('controllerNode');
$container->set('HTTPRequest', null, $httpRequest);
$container->set('HTTPResponse', null, $httpResponse);

$container->set('loadedParams', null, iterateComponentConfigurations($eventDispatcher));
$container->set('EventDispatcher', null, $eventDispatcher);
if(array_key_exists('langFiles', $controllerNode)) {
    $langFilesList = array_merge($langFilesList, $controllerNode['langFiles']);    
}

$httpRequest->setAttribute('langFilesList', $langFilesList);


//fire any on_entry events for all uris
$container->get('EventDispatcher')->dispatch('all', 'entry_point');


function iterateComponentConfigurations(EventDispatcher $eventDispatcher) {
    global $logger;
    global $langFilesList;
    
    $retval = array();
    $parser = new YAMLParser($logger);
    $parser->setFilePath(__SITE_PATH . '/config/bootstrap.yml');
    $bootstraps = $parser->loadConfig(); //$parser->findNodeByURI(KernelEvents::REQUEST_START, 'listeners');
    
    if(array_key_exists('langFiles', $bootstraps['all']['defaults'])) {
        $langFilesList = $bootstraps['all']['defaults']['langFiles'];
    }

    $eventDispatcher->configListeners($bootstraps);
    $retval[] = $bootstraps;
    $subdirectories = getDirectoryList();
    $componentBootstraps = array();
    
    foreach ($subdirectories as $folder) {
       // $parser->setFilePath($folder . '/config/bootstrap.yml');
        $parser->setFilePath($folder . '/config/routing.yml');
        $config = $parser->loadConfig(); 
      
        if(is_array($config)) {
            $eventDispatcher->configListeners($config);  
            $retval[] = $config;
        }
        
    }
    
    return $retval;
}

function getDirectoryList() {
    
    $retval = array();
    if ($handle = opendir(__SITE_PATH . '/src/components')) {
        $blacklist = array('.', '..', 'somedir', 'somefile.php');
        while (false !== ($file = readdir($handle))) {
            if (!in_array($file, $blacklist)) {
                $retval[] = __SITE_PATH . '/src/components/' . $file;
            }
        }
        closedir($handle);
    }
    if ($handle = opendir(__SITE_PATH . '/app/core/components')) {
        $blacklist = array('.', '..', 'somedir', 'somefile.php');
        while (false !== ($file = readdir($handle))) {
            if (!in_array($file, $blacklist)) {
                $retval[] = __SITE_PATH . '/app/core/components/' . $file;
            }
        }
        closedir($handle);
    }

    return $retval;
}
