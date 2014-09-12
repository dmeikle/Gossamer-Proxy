<?php

define('__SITE_PATH','/var/www/phoenix-portal/htdocs');

require_once('/var/www/phoenix-portal/htdocs/vendor/composer/ClassLoader.php');
 $loader = new Composer\Autoload\ClassLoader();
 
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
      $loader->add('Monolog', __SITE_PATH.'/vendor/monolog/monolog/src');
 
      // activate the autoloader
      $loader->register();
 
      // to enable searching the include path (eg. for PEAR packages)
      $loader->setUseIncludePath(true);
