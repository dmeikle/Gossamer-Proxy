<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Vancouver');

$site_path = realpath(dirname(__FILE__)); // strip the /web from it
$site_path = str_replace('/gcmstests', '', $site_path);

define('__SITE_PATH', $site_path);
define('__CACHE_DIRECTORY', $site_path . '/app/cache');
define('__DEBUG_OUTPUT_PATH', '/var/www/ip2/binghan.com/logs/phpunit.log');
//include_once('phpunit.configuration.php');
require_once(__SITE_PATH . '/vendor/composer/ClassLoader.php');
require_once 'phpunit.systemfunctions.php';
$loader = new Composer\Autoload\ClassLoader();

// register classes with namespaces
$loader->add('components', __SITE_PATH . '/src');
$loader->add('core', __SITE_PATH . '/app/framework');
$loader->add('libraries', __SITE_PATH . '/app/framework');
$loader->add('Gossamer\\Horus', __SITE_PATH . '/vendor/horus/caching/src');
$loader->add('Gossamer\\Caching', __SITE_PATH . '/vendor/gossamer/caching/src');
$loader->add('Gossamer\\Pesedget', __SITE_PATH . '/vendor/gossamer/pesedget/src');

$loader->add('Monolog', __SITE_PATH . '/vendor/monolog/monolog/src');

// activate the autoloader
$loader->register();

// to enable searching the include path (eg. for PEAR packages)
$loader->setUseIncludePath(true);

function super_unset($item) {
    try {
        if (is_object($item) && method_exists($item, "__destruct")) {
            $item->__destruct();
        }
    } catch (\Exception $e) {

    }
    //unset($item);
    $item = null;
}

























echo "\r\n********** phpunit.bootstrap complete *************\r\n";
