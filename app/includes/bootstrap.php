<?php

use libraries\utils\YAMLConfiguration;
use libraries\utils\YAMLParser;
use Monolog\Logger;
use core\AbstractComponent;
use core\http\HTTPRequest;
use core\http\HTTPResponse;
use core\datasources\DatasourceFactory;
#use core\eventlisteners\EventDispatcher;
use core\eventlisteners\EventDispatcher;

$logger = new Logger('namespace');
$langFilesList = array();
$configuration = new YAMLConfiguration($logger);
//error_log(__REQUEST_URI);
//echo __REQUEST_URI;

$nodeConfig = $configuration->getNodeParameters(__REQUEST_URI);


$controllerNode = $nodeConfig['defaults'];
$controllerNode['pattern'] = $nodeConfig['pattern'];

define('__YML_KEY', $nodeConfig['ymlKey']);
define('__VIEW_KEY', $controllerNode['viewKey']);
define('__COMPONENT_FOLDER', $nodeConfig['componentFolder']);
define('__NAMESPACE', $nodeConfig['namespace']);
//echo '<br>key: '.__YML_KEY;
$datasources = $container->get('datasources', array());

//set the datasource for this model based on its current key
$datasources[$controllerNode['model']] = $controllerNode['datasource'];
$container->set('datasources', 'array', $datasources);
//set the datasource element now so we can call it throughout seamlessly
$container->set('datasourceFactory', 'core\datasources\DatasourceFactory');

$container->set('nodeConfig', null, $nodeConfig);
$container->set('controllerNode', null, $controllerNode);
$httpRequest = new HTTPRequest($_REQUEST, $controllerNode['pattern']);

//added July 19, 2015 - some areas with no container access might need access to config
$httpRequest->setNodeConfig($nodeConfig);

$httpResponse = new HTTPResponse();
$eventDispatcher = new EventDispatcher(null, $container->get('Logger'), $httpRequest, $httpResponse);
$eventDispatcher->setDatasources($container->get('datasourceFactory'), $datasources);

$controllerNode = $container->get('controllerNode');
$container->set('HTTPRequest', null, $httpRequest);
$container->set('HTTPResponse', null, $httpResponse);
$container->set('loadedParams', null, iterateComponentConfigurations($eventDispatcher));
$container->set('EventDispatcher', null, $eventDispatcher);
//now lets hook all of our services before we go any further
$serviceManager = new core\services\ServiceManager($logger, loadServiceConfigurations(), $container->get('datasourceFactory'), $container);
////TODO: I've loaded the manager - now I need to decide whether to execute it on dispatcher:entry_point or simply call it 'as is'
//$serviceManager->executeService('simple_auth');
$serviceDispatcher = new \core\services\ServiceDispatcher($logger, new YAMLParser($logger));
$serviceDispatcher->dispatch($serviceManager);


if (array_key_exists('langFiles', $controllerNode) && is_array($controllerNode['langFiles'])) {
    $langFilesList = array_merge($langFilesList, $controllerNode['langFiles']);
}

$container->get('HTTPRequest')->setAttribute('langFilesList', $langFilesList);

try {
    //fire any on_entry events for all uris
    $container->get('EventDispatcher')->dispatch('all', 'entry_point');
    $container->get('EventDispatcher')->dispatch(__YML_KEY, 'entry_point');
} catch (core\components\security\exceptions\TokenExpiredException $e) {
    pr($e);
    include __SITE_PATH . '/src/themes/default/templates/errorPages/token.php';
    die;
} catch (core\components\security\exceptions\TokenMissingException $e) {
    include __SITE_PATH . '/src/themes/default/templates/errorPages/token.php';
    die;
} catch (Validation\Exceptions\ValidationFailedException $e) {
    //we need it to carry to the component so that we can send a proper view
    //so ignore this error but set an exception flag in the request we can
    //check for
    $container->get('HTTPRequest')->setAttribute('ExceptionOccurred', true);
} catch (\exceptions\JSONException $e) {
    echo $e->getMessage();
    die;
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    include __SITE_PATH . '/src/themes/default/templates/errorPages/general.php';
    die;
}

function iterateComponentConfigurations(EventDispatcher $eventDispatcher) {
    global $logger;
    global $langFilesList;

    $retval = array();
    $parser = new YAMLParser($logger);
    $parser->setFilePath(__SITE_PATH . '/app/config/bootstrap.yml');
    $bootstraps = $parser->loadConfig(); //$parser->findNodeByURI(KernelEvents::REQUEST_START, 'listeners');

    if (array_key_exists('langFiles', $bootstraps['all']['defaults'])) {
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

        if (is_array($config)) {
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
    if ($handle = opendir(__SITE_PATH . '/app/framework/core/components')) {
        $blacklist = array('.', '..', 'somedir', 'somefile.php');
        while (false !== ($file = readdir($handle))) {
            if (!in_array($file, $blacklist)) {
                $retval[] = __SITE_PATH . '/app/framework/core/components/' . $file;
            }
        }
        closedir($handle);
    }
    if ($handle = opendir(__SITE_PATH . '/src/extensions')) {
        $blacklist = array('.', '..', 'somedir', 'somefile.php');
        while (false !== ($file = readdir($handle))) {
            if (!in_array($file, $blacklist)) {
                $retval[] = __SITE_PATH . '/src/extensions/' . $file;
            }
        }
        closedir($handle);
    }

    return $retval;
}

function loadServiceConfigurations() {
    global $logger;
    $subdirectories = getDirectoryList();
    $serviceBootstraps = array();
    $parser = new YAMLParser($logger);
    //first load the system service configurations
    $parser->setFilePath(__SITE_PATH . '/app/config/services.yml');
    $config = $parser->loadConfig();

    if (is_array($config)) {
        $serviceBootstraps[] = $config;
    }
    //now load all the component configurations
    foreach ($subdirectories as $folder) {
        $parser->setFilePath($folder . '/config/services.yml');
        $config = $parser->loadConfig();

        if (is_array($config)) {
            $serviceBootstraps[] = $config;
        }
    }

    return $serviceBootstraps;
}
