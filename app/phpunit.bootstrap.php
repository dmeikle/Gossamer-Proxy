
<?php

include_once('phpunit.configuration.php');
require_once('vendor/composer/ClassLoader.php');
$loader = new Composer\Autoload\ClassLoader();

// register classes with namespaces
$loader->add('components', __SITE_PATH . '/src');
$loader->add('usercommands', __SITE_PATH . '/src');
$loader->add('userentities', __SITE_PATH . '/src');
$loader->add('controllers', __SITE_PATH . '/src/framework');
$loader->add('core', __SITE_PATH . '/src/framework');
$loader->add('database', __SITE_PATH . '/src/framework');
$loader->add('entities', __SITE_PATH . '/src/framework');
$loader->add('exceptions', __SITE_PATH . '/src/framework');
$loader->add('listeners', __SITE_PATH . '/src/framework');
$loader->add('libraries', __SITE_PATH . '/src/framework');
$loader->add('security', __SITE_PATH . '/src/framework');
$loader->add('Monolog', __SITE_PATH . '/vendor/monolog/monolog/src');

// activate the autoloader
$loader->register();

// to enable searching the include path (eg. for PEAR packages)
$loader->setUseIncludePath(true);
