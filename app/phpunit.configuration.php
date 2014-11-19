<?php
//TODO change to use filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING)
//if(strlen($_SERVER['REQUEST_URI']) < 2) {
//    $_SERVER['REQUEST_URI'] = 'default/index';
//}
//$uriPieces = parse_url($_SERVER['REQUEST_URI']);

date_default_timezone_set('America/Vancouver');

$site_path =  substr(realpath(dirname(__FILE__)),0, strlen($_SERVER['DOCUMENT_ROOT']) - 4);// strip the /web from it

 define ('__SITE_PATH', $site_path);
 define('__SITE_NAME', 'phoenix-portal');
 define('__XML_CONFIG_PATH', __SITE_PATH .DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR
    . 'config' . DIRECTORY_SEPARATOR . 'web.xml');
 //define('__URI', $requestURI);
