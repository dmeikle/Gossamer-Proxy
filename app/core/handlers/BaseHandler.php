<?php

namespace core\handlers;

use Monolog\Logger;

abstract class BaseHandler
{
    protected $logger = null;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    protected function checkFileIsStale($filepath, $rootFolder) {

        if(!file_exists($this->getDestinationFilepath($filepath, $rootFolder))) {
            return true;
        }

        $sourceTime = filemtime($this->getOriginFilePath($filepath, $rootFolder));
        $destinationTime = filemtime($this->getDestinationFilepath($filepath, $rootFolder));

        //check to see if there is a newer file placed on server
        return $sourceTime > $destinationTime;
    }

    protected function getOriginFilePath($filepath) {

        return __SITE_PATH . '/src/components' . $filepath;
    }

    protected function getDestinationFilepath($filepath, $rootFolder) {
        $filepath = str_replace('/includes/'  . $rootFolder, '', $filepath);

        return __SITE_PATH . '/web/' . $rootFolder .'/components' . $filepath;
    }

    protected function copyFile($filepath, $rootFolder) {
        $filepath = trim($filepath);
        $filepathWithFile = str_replace( '/includes/' . $rootFolder . '/','/', $filepath);

        $chunks = explode('/', $filepathWithFile);

        $filename = array_pop($chunks);
        $old_umask = umask(0);
        $parsedFromPath = __SITE_PATH . '/src/components';
        $parsedToPath = __SITE_PATH . '/web/' . $rootFolder . '/components' . implode('/', $chunks);
        chmod(__SITE_PATH . '/' . $rootFolder . '/', 777);
        mkdir($parsedToPath, 0777, true);
        chmod(__SITE_PATH . '/' . $rootFolder . '/', 0755);
        umask($old_umask);

        copy($parsedFromPath . $filepath, $parsedToPath . '/' . $filename );
        chmod($parsedToPath, 0755);

        return  '/web/' . $rootFolder . '/components/' . implode('/', $chunks) . $filename;
    }

    protected function getOccurrences($content, $tagName)
    {
        $lastPos = 0;
        $positions = array();
        while (($lastPos = strpos($content, $tagName, $lastPos))!== false)
        {
            $positions[] = $lastPos;
            $lastPos = $lastPos + strlen($tagName);
        }
        
        return $positions;
    }
    
    public abstract function handleRequest($params = array());
}