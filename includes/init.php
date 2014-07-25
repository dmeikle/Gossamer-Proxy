<?php


 $loader = new \Composer\Autoload\ClassLoader();
 
      // register classes with namespaces
      $loader->add('components', __SITE_PATH .'/src');
      $loader->add('usercommands', __SITE_PATH.'/src');
      $loader->add('userentities', __SITE_PATH.'/src');
      $loader->add('controllers', __SITE_PATH.'/app');
      $loader->add('core', __SITE_PATH.'/app');
      $loader->add('database', __SITE_PATH.'/app');
      $loader->add('entities', __SITE_PATH.'/app');
      $loader->add('exceptions', __SITE_PATH.'/app');
      $loader->add('listeners', __SITE_PATH.'/app');
      $loader->add('libraries', __SITE_PATH.'/app');
      $loader->add('security', __SITE_PATH.'/app');
 
      // activate the autoloader
      $loader->register();
 
      // to enable searching the include path (eg. for PEAR packages)
      $loader->setUseIncludePath(true);

 
use core\Main;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use libraries\utils\Container;

$container = new Container();
$logger = new Logger('rest_service');
$logger->pushHandler(new StreamHandler( __SITE_PATH . "/../logs/monolog.log", Logger::DEBUG));
$container->set('Logger', 'Monolog\Logger', $logger);
$logger->addDebug('logger set into container');


function pr($item){
    echo '<pre>\r\n';
    print_r($item);
    echo'</pre>\r\n';
}

