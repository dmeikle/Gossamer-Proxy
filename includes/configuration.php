<?php
if(strlen($_SERVER['REQUEST_URI']) < 2) {
    $_SERVER['REQUEST_URI'] = 'default/index';
}
$uriPieces = parse_url($_SERVER['REQUEST_URI']);

date_default_timezone_set('America/Vancouver');

$site_path =  $_SERVER['DOCUMENT_ROOT'] ;// realpath(dirname(__FILE__));
$requestURI = $uriPieces['path'];

 
if(substr($requestURI,-1,1) != '/'){
    $requestURI .='/';
}

 define ('__SITE_PATH', $site_path);
 define('__SITE_NAME', $_SERVER['SERVER_NAME']);
 define('__XML_CONFIG_PATH', __SITE_PATH .DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR
    . 'config' . DIRECTORY_SEPARATOR . 'web.xml');
 define('__URI', $requestURI);


function findConfigKeyByURIPattern($configList, $node, $uriPattern)
{
    $comparator = new URIComparator();
    
    $uriConfig = $comparator->findPattern($configList, $uriPattern);
    unset($comparator);
  
    return $uriConfig;
}