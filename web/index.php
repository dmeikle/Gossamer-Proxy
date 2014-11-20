<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


//these are included in order of operation - do not change!
include_once('includes/configuration.php');
include_once('../vendor/autoload.php');
include_once('includes/init.php');
include_once('includes/bootstrap.php');
//validator test from composer
//
//use Validation\Validator;
//$loader = new Validation\YamlConfiguration();
//$loader->loadConfig(__SITE_PATH . '/app/config/validation-config.yml');
//echo __SITE_PATH . '/app/config/validation-config.yml';
//
////YAML key $key = 'new_user_signup'; 
//$validator = new Validator($loader, $logger); //Monolog\Logger
//$key = 'new_user_signup';
//$result = $validator->validateRequest($key, array('firstname' => 'daw3ve'));
//pr($result);

use core\system\Kernel;
use core\system\KernelEvents;

$kernel = new Kernel($container, $logger);
$kernel->run();

unset($kernel);


$container->get('EventDispatcher')->dispatch(KernelEvents::TERMINATE, 'terminate');
