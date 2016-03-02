<?php

session_start();

//TODO change to use filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING)
if (strlen($_SERVER['REQUEST_URI']) < 2) {
    $_SERVER['REQUEST_URI'] = 'default/index';
}
$uriPieces = parse_url($_SERVER['REQUEST_URI']);

date_default_timezone_set('America/Vancouver');


$site_path = getParentFolder($_SERVER['DOCUMENT_ROOT']); //get the path withou /web on it

$requestURI = $uriPieces['path'];

if (substr($requestURI, 0, 1) == '/') {
    $requestURI = substr($requestURI, 1); //strip the preceding '/'
}

define('__MAX_DECAY_TIME', 1200);
define('__ABOVE_ROOT_PATH', getParentFolder($site_path));
define('__REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);
define('__SITE_PATH', $site_path);
define('__CONFIG_PATH', $site_path . '/app/config/');
define('__LOG_PATH', $site_path . '/app/logs/');
define('__SITE_NAME', $_SERVER['SERVER_NAME']);
define('__XML_CONFIG_PATH', __SITE_PATH . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR
        . 'config' . DIRECTORY_SEPARATOR . 'web.xml');
define('__URI', $requestURI);
define('__REQUEST_URI', $requestURI);
define('__CACHE_DIRECTORY', __SITE_PATH . '/app/cache/');
define('__UPLOADED_IMAGES_PATH', $site_path . '/images/'); //this is in the root of the site, outside of web folder
define('__UPLOADED_FILES_PATH', $site_path . '/uploads/'); //this is in the root of the site, outside of web folder

function findConfigKeyByURIPattern($configList, $node, $uriPattern) {
    $comparator = new URIComparator(new \Gossamer\Caching\CacheManager());

    $uriConfig = $comparator->findPattern($configList, $uriPattern);
    unset($comparator);

    return $uriConfig;
}

function getParentFolder($path) {
    $tmp = explode('/', $path);
    //drop the last folder name
    array_pop($tmp);
    $abovePath = implode('/', $tmp);

    return $abovePath;
}
