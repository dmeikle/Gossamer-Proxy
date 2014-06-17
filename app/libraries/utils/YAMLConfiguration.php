<?php

namespace libraries\utils;

use Monolog\Logger;

class YAMLConfiguration
{
    private $configs;
    
    public function __construct(Logger $logger, $filename, $node, $uriPattern = '') {
        $this->iterateComponentConfigurations($logger, $filename, $node, $uriPattern);
    }
        
    public function getConfigs() {
        return $this->configs;
    }
    
    private function iterateComponentConfigurations(Logger $logger, $filename, $node, $uriPattern) {
       
        $retval = array();
        $parser = new YAMLParser($logger);

        $parser->setFilePath(__SITE_PATH . '/config/' . $filename .'.yml');
        if(strlen($uriPattern) == 0) {
            $retval[] = $parser->findNodeByURI('all', $node); 
            //just in case it's a usercommand (not component) load any config for it here also
            $retval[] = $parser->findNodeByURI(__YML_KEY, $node); 
        } else {
            //just in case it's a usercommand (not component) load any config for it here also
            $retval[] = $parser->findNodeByURIPattern($uriPattern, $node); 
        }
   
        $subdirectories = $this->getDirectoryList();
        foreach ($subdirectories as $folder) {
            $parser->setFilePath($folder . '/config/' . $filename . '.yml');
            $config = $parser->findNodeByURI(__YML_KEY, $node); 
           if(is_array($config)) {
                $retval[] = $config;
            }
            
        }
       
        $this->configs = $retval;
    }
    
 
    private function getDirectoryList() {
        
        $retval = array();
        if ($handle = opendir(__SITE_PATH . '/src/components')) {
            $blacklist = array('.', '..', 'somedir', 'somefile.php');
            while (false !== ($file = readdir($handle))) {
                if (!in_array($file, $blacklist)) {
                    $retval[] = __SITE_PATH . '/src/components/' . $file;
                }
            }
            closedir($handle);
        }
    
        return $retval;
    }
}
