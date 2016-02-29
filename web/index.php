<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


//these are included in order of operation - do not change!
include_once('includes/configuration.php');
include_once('../vendor/autoload.php');
include_once('includes/init.php');
include_once('includes/bootstrap.php');

//echo(__YML_KEY . "\r\n");
//error_log(__YML_KEY);


use core\system\Kernel;
use core\system\KernelEvents;

$kernel = new Kernel($container, $logger);
$kernel->run();

error_log(memory_get_usage(true));

$container->get('EventDispatcher')->dispatch(KernelEvents::TERMINATE, 'terminate');

super_unset($kernel);


