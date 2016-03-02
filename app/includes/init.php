<?php

$loader = new \Composer\Autoload\ClassLoader();


// register classes with namespaces
$loader->add('components', __SITE_PATH . '/src');
$loader->add('usercommands', __SITE_PATH . '/src');
$loader->add('userentities', __SITE_PATH . '/src');
$loader->add('extensions', __SITE_PATH . '/src');
$loader->add('controllers', __SITE_PATH . '/app/framework');
$loader->add('core', __SITE_PATH . '/app/framework');
$loader->add('database', __SITE_PATH . '/app/framework');
$loader->add('entities', __SITE_PATH . '/app/framework');
$loader->add('exceptions', __SITE_PATH . '/app/framework');
$loader->add('listeners', __SITE_PATH . '/app/framework');
$loader->add('libraries', __SITE_PATH . '/app/framework');
$loader->add('security', __SITE_PATH . '/app/framework');

// activate the autoloader
$loader->register();

// to enable searching the include path (eg. for PEAR packages)
$loader->setUseIncludePath(true);

use core\Main;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use libraries\utils\Container;

$container = new Container();
buildLogger($container);

function pr($item) {
    echo '<pre>\r\n';
    print_r($item);
    echo'</pre>\r\n';
}

function getSession($key) {
    $session = $_SESSION;

    return fixObject($session[$key]);
}

function setSession($key, $value) {
    $_SESSION[$key] = $value;
}

function fixObject(&$object) {
    if (!is_object($object) && gettype($object) == 'object') {

        return ($object = unserialize(serialize($object)));
    }

    return $object;
}

function buildLogger(Container &$container) {
    $config = loadConfig();

    $loggerConfig = $config['logger'];

    $loggerClass = $loggerConfig['class'];
    $logger = new $loggerClass('client-site');

    $handlerClass = $loggerConfig['handler']['class'];
    $logLevel = $loggerConfig['handler']['loglevel'];
    $logFile = $loggerConfig['handler']['logfile'];

    $maxFiles = null;
    if (array_key_exists('maxfiles', $loggerConfig['handler'])) {
        $maxFiles = $loggerConfig['handler']['maxfiles'];
    }
    if (is_null($maxFiles)) {
        $logger->pushHandler(new $handlerClass(__LOG_PATH . $logFile, $logLevel));
    } else {
        $logger->pushHandler(new $handlerClass(__LOG_PATH . $logFile, $maxFiles, $logLevel));
    }
    $container->set('Logger', $loggerClass, $logger);
    $logger->addInfo('logger set into container');
}

function loadConfig() {
    $loader = new \libraries\utils\YAMLParser();
    $loader->setFilePath(__CONFIG_PATH . "config.yml");

    return $loader->loadConfig();
}
